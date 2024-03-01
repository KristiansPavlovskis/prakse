<template>
  <button @click.prevent="deleteGroup" class="bg-red-500 btn btn-sm btn-danger">Delete</button>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    groupId: {
      type: Number,
      required: true,
    },
  },
  methods: {
    deleteGroup() {
      const confirmed = window.confirm('Are you sure you want to delete this group?');
      if (confirmed) {
        axios
        .delete(`http://localhost/todos/groups/${this.groupId}/destroy`)
          .then((res) => {
            alert(res.data.message);
            this.$emit('groupDeleted', this.groupId);
            location.reload();
          })
          .catch((error) => {
            console.error('Error deleting group:', error);
          });
      }
    },
  },
};
</script>
