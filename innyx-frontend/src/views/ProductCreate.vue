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
  },
    methods: {
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


