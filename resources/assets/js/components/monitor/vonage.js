import Echo from '../../mixins/echo';
import Grid from '../grid';
import SaveState from '../../mixins/save-state';

export default {

    template: `
        <grid :position="grid" modifiers="overflow scroll padded blue">
            <section class="vonage">
                <h1 class="vonage__title">CALL ACTIVITY</h1>
                <table class="table__monitor">
                    <tr v-for="extension in extensions">
                        <td class="vonage__icon"><i class="fa {{ extension.callIcon }}"></i><i class="fa {{ extension.directionIcon }}"></i></td>
                        <td class="vonage__extension">{{ extension.extension }}</td>
                        <td class="vonage__name">{{ extension.name }}</td>
                        <td class="vonage__with">{{ extension.company }}</td>
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
            extensions: [],
        };
    },
    
    methods: {
        getEventHandlers() {
            return {
                'VonageApi.VonageExtensions': response => {
                    this.extensions = response.extensionInfo;
                },
            };
        },

        getSavedStateId() {
            return `vonage`;
        },
    },
};
