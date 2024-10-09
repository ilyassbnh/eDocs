import { createApp } from 'vue';
import router from './router'; // Import the router
import App from './App.vue';

const app = createApp(App);
app.use(router); // Add the router to the Vue app
app.mount('#app');
