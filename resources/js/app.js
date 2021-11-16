import {createApp} from 'vue';
import VirtualForm from '@/components/VirtualForm.vue';

const app = createApp({});
app.component('v-form', VirtualForm);

app.mount('#app');
