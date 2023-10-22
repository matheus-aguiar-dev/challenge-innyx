<template>
  <div class="container mt-5">
    <spinner v-if="loading" class="text-center"></spinner>
    <div v-else>
       <div class="mb-4 text-center">
          <router-link :to="{ name: 'categoriacreate' }">
            <button class="btn btn-purple">Criar nova Categoria</button>
          </router-link>
      </div>
      <div v-for="category in categories" :key="category.id" class="mb-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{ category.nome }}</h5>
            <!-- Add more category details if needed -->
            <div class="text-center">
	      <router-link :to="{ name: 'categoriaEdit', params: { index: category.id } }">
                <button class="btn btn-primary mx-2">Editar</button>
              </router-link>
              <button class="btn btn-danger" @click="deleteCategory(category.id)">Remover</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import Spinner from '@/components/Spinner.vue'; // Adjust the path based on your project structure

export default {
  data() {
    return {
      categories: [],
      loading: true,
    };
  },
  components: {
    Spinner,
  },

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
      console.log('User not authenticated');
    }
    axios.get("http://localhost:8000/api/categories")
      .then(response => {
        this.categories = response.data.data;
        this.loading = false;
      })
      .catch(error => {
        console.error("Error fetching categories:", error);
        this.loading = false;
      });
  },
    methods: {
    fetchCategories() {
      axios.get("http://localhost:8000/api/categories")
        .then(response => {
          this.categories = response.data.data;
          this.loading = false;
        })
        .catch(error => {
          console.error("Error fetching categories:", error);
          this.loading = false;
        });
    },
    async deleteCategory(categoryId) {
      try {
        await axios.delete(`http://localhost:8000/api/categories/${categoryId}`);
        console.log('Category deleted successfully');
        // Refresh the categories after successful deletion
        this.fetchCategories();
      } catch (error) {
        console.error('Error deleting category:', error);
      }
    },
  },
};
</script>
<style scoped>
.btn-purple {
  background-color: #800080; /* Purple color */
  color: #fff; /* Text color */
}

</style>
