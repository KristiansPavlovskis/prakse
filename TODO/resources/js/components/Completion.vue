<template>
    <button @click="toggleCompletion" :class="{ 'btn btn-sm btn-danger': !completed, 'btn btn-sm btn-success': completed }">
        {{ buttonText }}
    </button>
</template>


<script>
export default {
    props: {
        todoId: {
            type: Number,
            required: true
        },
        initialCompleted: {
            type: Boolean,
            required: true
        },
        todo: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            completed: this.initialCompleted,
            buttonText: this.initialCompleted ? 'Completed' : 'Not Completed'
        };
    },
    methods: {
    toggleCompletion() {

        // Toggle the completion status locally
        this.completed = !this.completed;
        this.buttonText = this.completed ? 'Completed' : 'Not Completed';

        // Send a POST request to mark the todo as completed
        axios.post(`/todos/${this.todo.id}/complete`)
            .then(response => {
            })
            .catch(error => {
                // Handle error
                console.error(error);
            });
    }
}


}
</script>
