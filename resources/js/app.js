import './bootstrap';



import { createApp, ref } from 'vue'
import Todo from './components/Todo.vue';

const app = createApp({
    setup() {
        return {
            count: ref(0)
        }
    }
});
app.component('Todo', Todo);
app.mount('#app');



