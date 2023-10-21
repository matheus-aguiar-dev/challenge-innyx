<template>
  <div class="about">
    <h1>Categoria</h1>
  </div>
</template>
<script>

import axios from "axios";

export default {
  created() {
    const token = localStorage.getItem('token');

    if (token) {
      axios.defaults.headers.common['Authorization'] = token;
      axios.get('http://localhost:8000/api/user')
        .then(response => {
          console.log('User data:', response.data);
        })
        .catch(error => {
          console.log('A problem occured');
        });
    } else {
          this.$router.push({ name: 'login' });
      console.log('User not authenticated');
    }
  },
};
</script>

<style>
/* Your styles here */
</style>
