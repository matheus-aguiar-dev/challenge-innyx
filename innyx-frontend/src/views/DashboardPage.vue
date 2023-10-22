<template>
  <div>
    <spinner v-if="loading"></spinner>
    <div v-else class="text-center container mt-5">
      <h1>Bem-vindo, {{ form.name }}!</h1>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Spinner from '@/components/Spinner.vue'; // Adjust the path based on your project structure

export default {
  data() {
    return {
      form: {
        name: '',
      },
      loading: true, // Move loading property outside of the form object
    };
  },
  components: {
    Spinner,
  },
  created() {
    const token = localStorage.getItem('token');

    if (token) {
      axios.defaults.headers.common['Authorization'] = token;
      axios.get('http://localhost:8000/api/user')
        .then(response => {
          this.form = response.data;
          this.loading = false; // Set loading to false after data is fetched
          console.log('User data:', response.data);
        })
        .catch(error => {
          console.log('A problem occurred');
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

