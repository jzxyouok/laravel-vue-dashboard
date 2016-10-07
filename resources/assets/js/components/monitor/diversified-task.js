import Echo from '../../mixins/echo';
import Grid from '../grid';
import SaveState from '../../mixins/save-state';

export default {

    template: `
         <grid :position="grid" modifiers="overflow scroll padded blue">
            <section class="diversified-task">
                <h1 class="task__title">Diversified Tasks</h1>
                <ul class="task__events">
                    <li v-for="task in tasks" class="task__event">
                        <h2 class="task__event__title">{{ task.title }}</h2>
                        <div class="task__event__due"><span class="task__field__label">Due:</span> {{ task.due | display-date }}</div>
                        <div class="task__event__updated"><span class="task__field__label">Updated:</span> {{ task.updated | display-date }}</div>
                        <div class="clearfix"></div>
                        <div class="task__event__status"><span class="task__field__label">Status:</span> {{ task.status }}</div>
                        <div class="task__event__notes">{{ task.notes }}</div>
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
            tasks: [],
        };
    },

    methods: {
        getEventHandlers() {
            return {
                'GoogleTasks.DiversifiedTasksFetched': response => {
                    this.tasks = response.tasks;
                },
            };
        },

        getSavedStateId() {
            return 'diversified-task';
        },
    },
};
