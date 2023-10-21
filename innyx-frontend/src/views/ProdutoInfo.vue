<template>
  <div class="container mt-5">
    <div v-if="loading" class="text-center">
      Loading...
    </div>
    <div v-else>
      <div class="row">
        <div class="col-md-4">
          <div class="card mb-4">
            <img :src="product.imagem" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">{{ product.nome}}</h5>
              <p class="card-text">id: {{ product.id }}</p>
              <p class="card-text">descrição: {{ product.descricao }}</p>
              <p class="card-text">:preço {{ product.preco }}</p>
              <p class="card-text">:data de validade:: {{ product.data_validade }}</p>
              <p class="card-text">categoria: {{ product.categoria_id}}</p>
              <!-- Add more product details as needed -->
	      <div class="text-center">
		  <button class="btn btn-purple mb-2">Visualizar</button>
		  <button class="btn mx-5 btn-blue mb-2">Editar</button>
		  <button class="btn btn-red mb-2">Excluir</button>
	     </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>

</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      product: null,
      loading: true,

    };
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
    axios.get("http://localhost:8000/api/produto/"+ this.$route.params.index)
      .then(response => {
        // Update the products data property with the received data

        this.product = response.data.data;
	console.log(this.product)

	this.loading = false; // Set loading to false in case of error
      })
      .catch(error => {
        console.error("Error fetching products:", error);
	this.loading = false; // Set loading to false in case of error==
      });
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

