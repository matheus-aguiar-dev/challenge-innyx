<template>
  <div id="content">
       <div class="containerLogin">
         <form @submit.prevent="login">
           <h2 class="mb-3 text-center">Login</h2>
           <div class="input">
             <label for="email">Email</label>
             <input
               class="form-control"
               type="text"
               name="email"
               placeholder="email@dominio.com"
               v-model="email"
             />
           </div>
           <div class="input">
             <label for="password">Senha</label>
             <input
               class="form-control"
               type="password"
               name="password"
               placeholder="senha"
               v-model="password"
             />
           </div>
           <button type="submit" class="mt-4 btn-pers" id="login_button">
             Login
           </button>
           <div
             class="alert alert-warning alert-dismissible fade show mt-5 d-none"
             role="alert"
             id="alert_1"
           ></div>
         </form>
       </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      email: "", // Data property to store email input value
      password: "" // Data property to store password input value
    };
  },
  created() {
    const token = localStorage.getItem('token');
    if (token) {
      axios.defaults.headers.common['Authorization'] = token;
      axios.get('http://localhost:8000/api/user')
        .then(response => {
          console.log('User data:', response.data);
          this.$router.push({ name: 'dashboard' });
        })
        .catch(error => {
          console.error(error);
        });
    } else {
      console.log('User not authenticated');
    }
  },
  methods: {
    login() {
      // Replace these with your actual login form values
      const email = this.email;
      const password = this.password;

      // Make a POST request to the login endpoint
      axios.post("http://localhost:8000/api/login", {
        email: email,
        password: password,
      })
      .then(response => {
        console.log(response.data);
        localStorage.setItem('token', `Bearer ${response.data.token}`);
        window.location.reload();
      })
      .catch(error => {
        // Handle login error
        console.error(error);
      });
    },
  },
};
</script>

<style>
/* Your styles here */
</style>

