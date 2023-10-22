<template>
  <div class="container mt-5">
    <div v-if="loading" class="text-center">Loading...</div>
    <div v-else>
      <div class="mb-3">
        <label for="name" class="form-label">Category Name:</label>
        <input type="text" class="form-control" v-model="form.nome" required>
      </div>
      <div class="text-center">
        <button class="btn btn-primary" @click="updateCategory">Update Category</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      form: {
        name: '',
      },
      loading: true,
    };
  },
  created() {
    const token = localStorage.getItem('token');
    axios.defaults.headers.common['Authorization'] = token;

    const categoryId = this.$route.params.index;
    this.fetchCategory(categoryId);
  },
  methods: {
    fetchCategory(categoryId) {
      axios.get(`http://localhost:8000/api/categories/${categoryId}`)
        .then(response => {
          this.form = response.data.data;
          this.loading = false;
        })
        .catch(error => {
          console.error("Error fetching category:", error);
          this.loading = false;
        });
    },
    async updateCategory() {
      try {
        const categoryId = this.$route.params.index;
        await axios.put(`http://localhost:8000/api/categories/${categoryId}`, this.form);
        // Redirect to the categories list page after successful update
        this.$router.push({ name: 'categorias' });
      } catch (error) {
        console.error('Error updating category:', error);
      }
    },
  },
};
</script>

<style scoped>
/* Your component styles here */
</style>

