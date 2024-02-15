<template>
  <button @click.prevent="deleteTodo" class="bg-red-500 btn btn-sm btn-danger">Dzēst</button>

</template>

<script>
import axios from 'axios';

export default {
  props: {
    todoId: {
      type: Number,
      required: true,
    },
  },
  methods: {
    deleteTodo() {
      const confirmed = window.confirm('Tiešām gribi izdzēst TODO?');
      if (confirmed) {
        axios
          .delete(`http://localhost/todos/${this.todoId}/destroy`)
          .then((res) => {
            alert(res.data.message);
            this.$emit('todoDeleted', this.todoId);
            location.reload();
          })
          .catch((error) => {
            console.error('Error deleting todo:', error);
          });
      }
    },
  },
};
</script>
