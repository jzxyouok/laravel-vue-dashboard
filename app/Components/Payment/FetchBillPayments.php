<?php

namespace App\Components\Payment;

use App\Events\Payment\PaymentsFetched;
use Illuminate\Console\Command;
use Carbon\Carbon;
use DateTime;
use App\Models\BillPayCompany;
use App\Models\Payment;
use App\Components\Payment\Exceptions\BadResponse;
use DB;

class FetchBillPayments extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'dashboard:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch current BillPay payments.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $payments_since = Carbon::today();
        $payments_since->setTimezone($payments_since->getTimezone());

        $paymentInfo = collect(DB::connection('billpay')->table('customer_transactions as bt')
            ->join('customer_transactions as ft', function ($join) {
                $join->on('ft.CompanyId', '=', 'bt.CompanyId')
                    ->on('ft.CustomerId', '=', 'bt.CustomerId')
                    ->where('ft.FeeTransaction', '=', 'Y');
            })
            ->selectRaw('
                IF(LOWER(REPLACE(bt.CCTYPE, " ", "-")) = "american-express", "amex", LOWER(REPLACE(bt.CCTYPE, " ", "-"))) as payment_type,
                COUNT(bt.Id) as transaction_count,
                sum(bt.Amount) AS bill_amount,
                sum(ft.Amount) AS fee_amount'
            )
            ->groupBy('payment_type')
            ->where('bt.TransDate', '>=', $payments_since)
            ->where('ft.TransDate', '>=', $payments_since)
            ->whereNull('bt.FeeTransaction')
            ->get())
            ->map(function ($payment) {
                return [
                    'payment_type' => $payment->payment_type,
                    'transaction_count'  => $payment->transaction_count,
                    'fee_amount'   => $payment->fee_amount,
                    'bill_amount'   => $payment->bill_amount,
                ];
            })
            ->toArray();

        event(new PaymentsFetched($paymentInfo));
    }
}
