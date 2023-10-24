import { createApp } from 'vue';
import App from './App.vue';
import router from './router'; // Import your router configuration
import 'bootstrap/dist/css/bootstrap.css';
import '@fortawesome/fontawesome-free/css/all.css'; 

const app = createApp(App);

// Use the Vue Router instance
app.use(router);

app.mount('#app');

