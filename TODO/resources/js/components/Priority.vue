<template>
  <button @click="togglePriority" :class="{ 'btn btn-sm btn-success': priority === 0, 'btn btn-sm btn-primary': priority === 1, 'btn btn-sm btn-danger': priority === 2 }">
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
      initialPriority: {
          type: Number,
          required: true
      },
      todo: {
          type: Object,
          required: true
      }
  },
  data() {
      return {
          priority: this.initialPriority,
          buttonText: this.initialPriority === 0 ? 'Low' : this.initialPriority === 1 ? 'Medium' : 'High'
      };
  },
  methods: {
    togglePriority() {
    // Toggle the priority locally
    this.priority = (this.priority + 1) % 3; // Toggle between 0, 1, 2
    
    // Update buttonText based on priority
    if (this.priority === 0) {
        this.buttonText = 'Low';
    } else if (this.priority === 1) {
        this.buttonText = 'Medium';
    } else {
        this.buttonText = 'High';
    }

    // Update the priority via API
    axios.post(`/todos/update-priority/${this.todo.id}`, {
        priority: this.priority
    })
    .then(response => {
        // Handle success
        console.log('Priority updated:', this.priority);
    })
    .catch(error => {
        // Handle error
        console.error(error);
    });
}

  }
}
</script>
