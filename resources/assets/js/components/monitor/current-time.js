import Grid from '../grid';
import moment from 'moment';

export default {

    template: `
        <grid :position="grid">
            <section class="current-time">
                <time class="current-time__content">
                    <span class="current-time__time">{{ time }}</span><br>
                    <span class="current-time__date">{{ date }}</span>
                </time>
            </section>
        </grid>
    `,

    components: {
        Grid,
    },

    props: {
        dateformat: {
            type: String,
            default: 'MM-DD-YYYY',
        },
        timeformat: {
            type: String,
            default: 'h:mm:ss a',
        },
        grid: {
            type: String,
        },
    },

    data() {
        return {
            date: '',
            time: '',
        };
    },
    

    created() {
        this.refreshTime();

        setInterval(this.refreshTime, 1000);
    },

    methods: {
        refreshTime() {
            this.date = moment().format(this.dateformat);
            this.time = moment().format(this.timeformat);
        },
    },
};



