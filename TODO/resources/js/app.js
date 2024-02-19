import './bootstrap';
import { createApp } from 'vue';
import TodoList from './components/TodoList.vue';

const app = createApp({});

// Register the TodoList component globally
app.component('todo-list', TodoList);

// Mount the app on an element with the id 'app'
app.mount('#app');


