<template>
  <div>
    <button @click.prevent="shareTodoWithUser" class="bg-red-500 btn btn-sm btn-danger">Share</button>
    <button @click.prevent="unshareTodoWithUser" class="bg-red-500 btn btn-sm btn-danger">Unshare</button>
    <input type="text" class="form-control mt-2" v-model="userIdInput" placeholder="Enter user ID">
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    todoId: {
      type: Number,
      required: true,
    },
    groupId: {
      type: Number,
      default: null,
    },
  },
  data() {
    return {
      userIdInput: null
    };
  },
  methods: {
    shareTodoWithUser() {
      axios.post(`/todos/${this.todoId}/share`, { user_id: this.userIdInput }) 

    .then(response => {
      console.log(`Sharing Todo ID: ${this.todoId}`);
      console.log(`Share with User ID: ${this.userIdInput}`);
      console.log(`Associated Group ID: ${this.groupId}`);
      console.log(response.data.message);
    })
    .catch(error => {
      console.error(error);
    });
},

unshareTodoWithUser() {
  axios.post(`/todos/${this.todoId}/unshare`, { user_id: this.userIdInput })
    .then(response => {
      console.log(`Unsharing Todo ID: ${this.todoId}`);
      console.log(`Unsharing with User ID: ${this.userIdInput}`);
      console.log(`Associated Group ID: ${this.groupId}`);
      console.log(response.data.message);
    })
    .catch(error => {
      console.error(error);
    });
}

  }
};
</script>
