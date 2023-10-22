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
        <input type="text" class="form-control" v-model="form.categoria_id" required>
      </div>
      <div class="mb-3">
        <label for="imagem" class="form-label">Imagem:</label>
        <input type="file" class="form-control" ref="fileInput" @change="handleFileUpload" accept="image/*">
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
      }
    };
  },
   created() {
    const token = localStorage.getItem('token');
    axios.defaults.headers.common['Authorization'] = token;
    const productId = this.$route.params.index;
    this.fetchProduct(productId);
  },
    methods: {
    handleFileUpload(event) {
	    const file = event.target.files[0];
	    this.form.imagem = file;
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
         formData.append('nome', this.form.nome);
         formData.append('descricao', this.form.descricao);
         formData.append('preco', this.form.preco);
         formData.append('data_validade', this.form.data_validade);
	 formData.append('categoria_id', parseInt(this.form.categoria_id)); // Parse to integer
	 console.log('Form Data:', formData);
      
         try {
           await axios.put(`http://localhost:8000/api/produto/${productId}`,formData, {
             headers: {
	     'Content-Type': 'application/json',
             }
           });
           console.log('Product updated successfully');
           // Redirect or perform any necessary actions after successful update
         } catch (error) {
           console.error('Error updating product:', error);
           console.log("Error updating product:", error.response.data);
         }
    },
  },
};
</script>

<style>
/* Your styles here */
</style>

