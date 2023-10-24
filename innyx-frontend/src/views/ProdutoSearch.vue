<template>
  <div class="container mt-5">
    <spinner v-if="loading" class="text-center">
      
    </spinner>
    <div v-else>
	<div class="search-container mb-5">
	   <div class="input-group">
	       <span class="input-group-text">
	         <i class="fas fa-search search-icon"></i>
	       </span>
	     <input v-model="searchQuery" type="text" class="form-control" placeholder="Procure...">
	     <div class="input-group-append">
	     <router-link :to="{ name: 'produtosearch', query: { query: searchQuery } }" @click="searchAndReload">
	       <button class="btn btn-purple">Confirme</button>
	     </router-link>
	     </div>
	   </div>
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
import axios from 'axios';
export default {
  data() {
    return {
      products: [],  // Store search results here
      searchQuery:'',
    };
  },
  mounted() {
    const query = this.$route.query.query;
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
    // Make a request to the backend API using Axios
    axios.get(`http://localhost:8000/api/produtos/search?query=${query}`)
      .then(response => {
        this.products= response.data.data.data;  // Assuming the API response contains search results
	console.log(this.products.data)
      })
      .catch(error => {
        console.error('Error fetching search results:', error);
      });
  },
    methods: {
    searchAndReload() {
      // Perform your search logic here
      // For example, make an API request using Axios
      
      // After performing search logic, reload the page
      this.$router.push({ name: 'produtosearch', query: { query: this.searchQuery } });
      axios.get(`http://localhost:8000/api/produtos/search?query=${this.searchQuery}`)
	      .then(response => {
			      this.products= response.data.data.data;  // Assuming the API response contains search results
			      console.log(this.products.data)
			      })
      .catch(error => {
		      console.error('Error fetching search results:', error);
		      });
    }
  }

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
.search-container {
  display: flex;
  align-items: center;
}

.search-icon {
  margin-right: 10px; /* Adjust the spacing between the icon and the input field */
}
</style>


