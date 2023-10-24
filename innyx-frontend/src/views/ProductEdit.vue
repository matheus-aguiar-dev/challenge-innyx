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
        <input type="file" class="form-control"  v-modl="form.imagem" ref="fileInput" @change="handleFileUpload" accept="image/*">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
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
	imagem: null // Add this property for the image file
      },
      categories: [] // Store categories here
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

    const productId = this.$route.params.index;
    this.fetchProduct(productId);
    this.fetchCategories();
  },
    methods: {
    handleFileUpload(event) {
	    const file = event.target.files[0];
	    this.imagem = file;
    },
    async fetchCategories() {
      try {
        const response = await axios.get("http://localhost:8000/api/categories");
        this.categories = response.data.data;
      } catch (error) {
        console.error("Error fetching categories:", error);
      }
    },
    async fetchProduct(productId) {
      try {
        const response = await axios.get(`http://localhost:8000/api/produto/${productId}`);
        this.form = response.data.data; // Assuming response data structure matches your form fields
      } catch (error) {
        console.error('Error fetching product:', error);
      }
    },
    async submitForm() { 
         const productId = this.$route.params.index;
         const formData = new FormData();
         formData.append('id', this.form.id);
         formData.append('nome', this.form.nome);
         formData.append('descricao', this.form.descricao);
         formData.append('preco', this.form.preco);
         formData.append('data_validade', this.form.data_validade);
	 formData.append('categoria_id',this.form.categoria_id); // Parse to integer
	 console.log(this.form.categoria_id)
	 if(this.imagem != null){
		 formData.append("imagem", this.imagem);
	 }
	 formData.append('_method', 'PUT')
      
         try {
           await axios.post(`http://localhost:8000/api/produto/${productId}`,formData, {
             headers: {
	     'Content-Type': 'multipart/form-data',
             }
           });
           console.log('Product updated successfully');
	   this.$router.push(`/produto/${productId}`);
           // Redirect or perform any necessary actions after successful update
         } catch (error) {
           console.log("Error updating product:", error.response.data);
         }
    },
  },
};
</script>

<style>
/* Your styles here */
</style>

