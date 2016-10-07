import Echo from '../../mixins/echo';
import Grid from '../grid';
import SaveState from '../../mixins/save-state';

export default {

    template: `
         <grid :position="grid" modifiers="overflow scroll padded blue">
            <section class="diversified-calendar">
                <h1 class="calendar__title">Diversified Events</h1>
                <ul class="calendar__events">
                    <li v-for="event in events" class="calendar__event">
                        <h2 class="calendar__event__title">{{ event.name }}</h2>
                        <div class="calendar__event__date">{{ event.date | display-date }}</div>
                        <div class="calendar__event__time">{{ event | eventTime('start', 'end', 'allDay') }}</div>
                        <div class="clearfix"></div>
                    </li>
                </ul>
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
            events: [],
        };
    },

    methods: {
        getEventHandlers() {
            return {
                'GoogleCalendar.DiversifiedEventsFetched': response => {
                    this.events = response.events;
                },
            };
        },

        getSavedStateId() {
            return 'diversified-calendar';
        },
    },
};
