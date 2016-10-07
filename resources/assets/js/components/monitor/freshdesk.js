import Echo from '../../mixins/echo';
import Grid from '../grid';
import SaveState from '../../mixins/save-state';

export default {

    template: `
        <grid :position="grid" modifiers="overflow scroll padded blue">
            <section class="freshdesk">
                <h1 class="freshdesk__title">Current Tickets</h1>
                <table class="table__monitor">
                    <tr>
                        <th class="freshdesk__heading">Agent</th>
                        <th class="freshdesk__heading">Requestor</th>
                        <th class="freshdesk__heading">Ticket</th>
                        <th class="freshdesk__heading">Status</th>
                        <th class="freshdesk__heading">Date</th>
                    </tr>
                    <tr v-for="ticket in tickets">
                        <td class="freshdesk__agent">
                            {{ ticket.agent_name }}
                        </td>
                        <td class="freshdesk__requester">
                            {{ ticket.company_name }}<br>
                            {{ ticket.requester_name }}
                        </td>
                        <td class="freshdesk__ticket">
                            <div>#{{ ticket.ticket_id }} - {{ ticket.group_name }}</div>
                            <div class="freshdesk__subject">{{ ticket.subject }}</div>
                        </td>
                        <td class="freshdesk__status">
                            {{ ticket.status }}
                        </td>
                        <td class="freshdesk__date">
                            {{ ticket.updated_at | display-date-time }}
                        </td>
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
            tickets: [],
        };
    },
    
    methods: {
        getEventHandlers() {
            return {
                'Freshdesk.FreshdeskTicketsFetched': response => {
                    this.tickets = response.ticketInfo;
                },
            };
        },

        getSavedStateId() {
            return `freshdesk`;
        },
    },
};
