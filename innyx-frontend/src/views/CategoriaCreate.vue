<template>
  <div class="container mt-5">
    <div v-if="loading" class="text-center">Loading...</div>
    <div v-else>
      <div class="mb-3">
        <label for="name" class="form-label">Category Name:</label>
        <input type="text" class="form-control" v-model="form.nome" required>
      </div>
      <div class="text-center">
        <button class="btn btn-primary" @click="createCategory">Create Category</button>
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
