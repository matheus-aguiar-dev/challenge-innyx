<template>
  <div class="container mt-5">
    <spinner v-if="loading" class="text-center">
      
    </spinner>
    <div v-else>
      <div class="mb-4 text-center">
          <router-link :to="{ name: 'produtocreate' }">
            <button class="btn btn-purple">Criar novo produto</button>
          </router-link>
      </div>
      <div class="row">
        <div class="col-md-4" v-for="product in products" :key="product.id">
          <!-- Your product card layout here -->
          <div class="card mb-4">
            <img :src="`http://localhost:8000/images/${product.imagem}`" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">{{ product.nome }}</h5>
              <p class="card-text">{{ product.descricao }}</p>
              <p class="card-text">Preço: R$ {{ product.preco }}</p>
              <!-- Add more product details as needed -->
	      <div class="text-center">
	      <router-link :to="{ name: 'produto', params: { index: product.id } }">
		  <button class="btn btn-purple mb-2">Visualizar</button>
	      </router-link>
	      <router-link :to="{ name: 'produtoedit', params: { index: product.id } }">
		  <button class="btn mx-5 btn-blue mb-2">Editar</button>
	      </router-link>
	      <button class="btn btn-red mb-2" @click="deleteProduct(product.id)">Excluir</button>
	     </div>
            </div>
          </div>
        </div>

      </div>
      <div class="row justify-content-center">
	      <div class="col-12 text-center">
		      <pagination :total-pages="totalPages" :current-page="currentPage" @page-change="handlePageChange" />
	      </div>
      </div>
    </div>
  </div>

</template>

<script>
import axios from "axios";
import Pagination from '../components/Pagination.vue';
import Spinner from '@/components/Spinner.vue'; // Adjust the path based on your project structure


export default {
  data() {
    return {
      products: null,
      currentPage: 1, // Current page number
      totalPages: 1, // Total number of pages
      loading: true,

    };
  },
  components: {
    Pagination,
    Spinner
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
        this.fetchProducts(this.currentPage);
  },
  methods: {
   async deleteProduct(productId) {
      try {
         await axios.delete(`http://localhost:8000/api/produto/${productId}`);
         console.log('Product deleted successfully');
         // Reload the page after successful deletion
         window.location.reload();
      } catch (error) {
         console.error('Error deleting product:', error);
      }
   },
   handlePageChange(page) {
	   // Update the current page property with the selected page number
	   this.currentPage = page;
	   // Fetch products for the selected page
	   this.fetchProducts(page);

   },
   async fetchProducts(page) {
      try {
        // Make API request with the selected page number
        const response = await axios.get(`http://localhost:8000/api/produtos/?page=${page}`);
        // Update the products data property with the received data
        this.products = response.data.data.data;
        this.totalPages = response.data.data.last_page;
	console.log(this.products)
	this.loading=false
      } catch (error) {
        console.error("Error fetching products:", error);
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
.btn-red{
  background-color: red; /* Purple color */
  color: #fff; /* Text color */
}
.btn-blue{
  background-color: blue; /* Purple color */
  color: #fff; /* Text color */
}
</style>

