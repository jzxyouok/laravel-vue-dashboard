<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Payment extends Model
{
    use Notifiable;

    /**
     * The database connection
     *
     * @var array
     */
    protected $connection = 'billpay';

    /**
     * The table name
     *
     * @var string
     */
    protected $table = 'customer_transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Scope a query to only include fee payments.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFee($query)
    {
        return $query->where('FeeTransaction', '=', 'Y');
    }

    /**
     * Scope a query to only include bill payments.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBill($query)
    {
        return $query->whereNull('FeeTransaction');
    }

    /**
     * Scope a query to only include posted payments.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePosted($query)
    {
        return $query->where('Posted', '=', 'T');
    }

    /**
     * Scope a query to only include un-posted payments.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotPosted($query)
    {
        return $query->where('Posted', '<>', 'T')->whereNull('FeeTransaction');
    }

    /**
     * A Payment belongs to a Company.
     * 
     * @return Illuminate\Database\Eloquent\Model\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(BillPayCompany::class, 'CompanyId', 'Id');
    }
}
