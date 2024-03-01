import './bootstrap';
import { createApp } from 'vue';
import TodoList from './components/TodoList.vue';
import Counter from './components/Counter.vue';
import Completion from './components/Completion.vue';
import Priority from './components/Priority.vue';
import Share from './components/Share.vue';
const app = createApp({});

app.component('todo-list', TodoList);
app.component('counter', Counter);
app.component('completion', Completion);
app.component('priority', Priority);
app.component('share', Share);
app.mount('#app');


