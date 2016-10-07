import Echo from '../../mixins/echo';
import Grid from '../grid';
import SaveState from '../../mixins/save-state';

export default {

    template: `
        <grid :position="grid" modifiers="overflow padded blue">
            <section class="github-commit">
                <h1 class="github-commit__title">{{ message }}</h1>
                <div class="github-commit__content">
                    <div class="github-commit__committer">
                        {{ committer }}
                    </div>
                    <div class="github-commit__date">
                        {{ date | file-date }}
                    </div>
                </div>
                <hr>
                <h2 class="github-commit__file__title">Files</h2>
                <ul class="github-commit__files">
                    <li v-for="file in files" class="github-commit__file">
                        <span class="github-commit__file__name">{{ file.filename }}</span> - 
                        <span class="github-commit__file__status">{{ file.status }}</span>
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
            committer: '',
            date: '',
            message: '',
            files: [],
        };
    },

    methods: {
        getEventHandlers() {
            return {
                'GitHub.CommitFetched': response => {
                    console.log('response',response);
                    this.committer = response.commitInfo.committer;
                    this.date = response.commitInfo.date;
                    this.message = response.commitInfo.message;
                    this.files = response.commitInfo.files;
                },
            };
        },

        getSavedStateId() {
            return `github-commit`;
        },
    },
};
