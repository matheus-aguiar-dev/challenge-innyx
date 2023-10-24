<template>
  <div class="container mt-5">
    <form @submit.prevent="submitForm">
      <div class="mb-3">
        <label for="nome" class="form-label">Nome:</label>
        <input type="text" class="form-control" v-model="form.nome" required>
      </div>
      <div class="mb-3">
        <label for="descricao" class="form-label">Descrição:</label>
        <textarea class="form-control" v-model="form.descricao" required></textarea>
      </div>
      <div class="mb-3">
        <label for="preco" class="form-label">Preço:</label>
        <input type="number"  step=0.01 class="form-control" v-model="form.preco" required>
      </div>
      <div class="mb-3">
        <label for="data_validade" class="form-label">Data de Validade:</label>
        <input type="date" class="form-control" v-model="form.data_validade" required>
      </div>
      <div class="mb-3">
        <label for="categoria" class="form-label">Categoria:</label>
	<select class="form-select" v-model="form.categoria_id" required>
		<option value="" disabled>Selecione uma Categoria</option>
		<option v-for="category in categories" :value="category.id" :key="category.id">{{ category.nome }}</option>
	</select>
      </div>
      <div class="mb-3">
        <label for="imagem" class="form-label">Imagem:</label>
        <input type="file" class="form-control" ref="fileInput" @change="handleFileUpload" accept="image/*">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <pagination :total-pages="totalPages" :current-page="currentPage" @page-change="handlePageChange" />
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      form: {
        nome: '',
        descricao: '',
        preco: null,
        data_validade: null,
        categoria_id: null,
	imagem: null, // Add this property for the image file
      },
      categories: [], // Store categories here
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
    }

    this.fetchCategories();
  },
    methods: {
        async fetchCategories() {
      try {
        const response = await axios.get("http://localhost:8000/api/categories");
        this.categories = response.data.data;
      } catch (error) {
        console.error("Error fetching categories:", error);
      }
    },

    handleFileUpload(event) {
	    const file = event.target.files[0];
	    this.form.imagem = file;
    },
    async submitForm() { 
    const formData = new FormData();
      formData.append("nome", this.form.nome);
      formData.append("descricao", this.form.descricao);
      formData.append("preco", this.form.preco);
      formData.append("data_validade", this.form.data_validade);
      formData.append("categoria_id", this.form.categoria_id);
      formData.append("imagem", this.form.imagem);

      try {
        const response = await axios.post(
          "http://localhost:8000/api/produto/create",
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
              Authorization: `Bearer ${localStorage.getItem("token")}`,
            },
          }
        );

        console.log("Product created successfully", response.data);
	this.$router.push(`/produtos`);
        // Optionally, you can redirect the user to another page after successful submission.
      } catch (error) {
        console.error("Error creating product:", error);
      }
    },
  },
};
</script>

<style>
/* Your styles here */
</style>


