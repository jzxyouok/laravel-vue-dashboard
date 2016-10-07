import Echo from '../../mixins/echo';
import FullCalendar from '../fullcalendar';

export default {

    template: `
        <section class="main-fullcalendar">

        </section>
    `,

    data() {
        return {
            calendar: [],
        };
    },

    components: {
        FullCalendar
    },

    mixins: [Echo],

    methods: {
        getEventHandlers() {
            // return {
            //     'FullCalendar.ServiceBureauEventsFetched': response => {
            //         this.calendar = response.events;
            //     },
            // };
        },
    },

};
