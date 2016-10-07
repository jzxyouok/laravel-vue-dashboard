import Echo from '../../mixins/echo';
import Grid from '../grid';
import SaveState from '../../mixins/save-state';

export default {

    template: `
        <grid :position="grid" modifiers="overflow scroll padded blue">
            <section class="payment">
                <h1 class="payment__title">BILL PAY ACTIVITY</h1>
                <table class="table__monitor">
                    <tr>
                        <th class="payment__heading">Type</th>
                        <th class="payment__heading">Count</th>
                        <th class="payment__heading">Bills</th>
                        <th class="payment__heading">Fees</th>
                    </tr>
                    <tr v-for="payment in payments">
                        <td class="payment__type"><i class="fa fa-cc-{{ payment.payment_type }} fa-lg"></i></td>
                        <td class="payment__count">{{ payment.transaction_count }}</td>
                        <td class="payment__amount">{{ payment.bill_amount | currency }}</td>
                        <td class="payment__amount">{{ payment.fee_amount | currency }}</td>
                    </tr>
                    <tr>
                        <td class="payment__total__text">Totals:</td>
                        <td class="payment__total">{{ payments | sumTransactions 'transaction_count' }}</td>
                        <td class="payment__total">{{ payments | sumPayments 'bill_amount' | currency }}</td>
                        <td class="payment__total">{{ payments | sumPayments 'fee_amount' | currency }}</td>
                    </tr>
                </table>
            </section>
        </grid>
    `,

    components: {
        Grid,
    },

    mixins: [Echo, SaveState],

    props: ['grid'],

    data() {
        return {
            payments: [],
        };
    },
    
    methods: {
        getEventHandlers() {
            return {
                'Payment.PaymentsFetched': response => {
                    this.payments = response.paymentInfo;
                },
            };
        },

        getSavedStateId() {
            return `payment`;
        },
    },
};
