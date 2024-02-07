<template>
    <div>
      <h1 class="text-3xl font-bold text-center text-gray-900">Kristians Pavlovskis</h1>
      <p>{{ count }}</p>
      <button @click="increment" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" href="welcome1.blade.php"> Add</button>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  
  const count = ref(0)
  
  const increment = () => {
    count.value++
  }
  </script>
  