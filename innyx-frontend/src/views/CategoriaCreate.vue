<template>
  <div class="container mt-5">
    <div v-if="loading" class="text-center">Loading...</div>
    <div v-else>
      <div class="mb-3">
        <label for="name" class="form-label">Nome da Categoria:</label>
        <input type="text" class="form-control" v-model="form.nome" required>
      </div>
      <div class="text-center">
        <button class="btn btn-primary" @click="createCategory">Criar Categoria</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {

  created() {
    const token = localStorage.getItem('token');
    axios.defaults.headers.common['Authorization'] = token;

    if (token) {
      axios.get('http://localhost:8000/api/user')
        .then(response => {
          console.log('User data:', response.data);
          // Continue with your logic, e.g., store user data in Vuex state
        })
        .catch(error => {
          console.log('A problem occurred');
          // Handle errors, e.g., show an error message to the user
        })
        .finally(() => {
          // Redirect the user to the login page after API request is complete
        });
    } else {
      // Redirect the user to the login page if there is no token
      this.$router.push({ name: 'login' });
    }
  },

  data() {
    return {
      form: {
        name: '',
      },
      loading: false,
    };
  },
  methods: {
    async createCategory() {
      try {
        this.loading = true;
        await axios.post(`http://localhost:8000/api/categories`, this.form);
        console.log('Category created successfully');
        this.$router.push({ name: 'categorias' });
      } catch (error) {
        console.error('Error creating category:', error);
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>

<style scoped>
/* Your component styles here */
</style>
