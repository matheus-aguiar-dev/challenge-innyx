<template> 
<div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-purple justify-content-center">
      <a class="navbar-brand" href="/" style="font-family: 'Arial', sans-serif; font-size:60px;">Innyx</a>
    </nav>
    <div v-if="hastoken">
      <sidebar   @button-exit-clicked="logout" @menuClicked="handleMenuClick" />
      <router-view />
    </div>
    <router-view v-else />
</div>
</template>

<script>
import Sidebar from "@/components/SideBar.vue";

export default {
  name: "App",
  components: {
    Sidebar,
  },
  data() {
    return {
      hastoken: localStorage.getItem("token"), // Check if token exists in localStorage
    };
  },
  methods: {
    logout() {
      localStorage.removeItem("token");
      this.hastoken = null; // Set hastoken to null after logout
      window.location.reload();
    },
    handleMenuClick(event){
      this.$router.push({ name: event });
    }
  },
};
</script>


<style>
/* CUSTOM STYLE */

html{
background:#d0dcff;
}
#content {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  border: 1px solid lightgray;
  padding: 4rem 4rem;
  border-radius: 5px;
  background: #fefefe;
}

.background {
  width: 100vw;
  height: 100vh;
  position: absolute;
  background: rgb(250, 250, 250);
}

.navbar {
  background: #540094;
  position: absolute;
  top: 0;
  width: 100vw;
  height: 80px;
  box-shadow: 6.7px 6.7px 5.3px rgba(0, 0, 0, 0.028),
    22.3px 22.3px 17.9px rgba(0, 0, 0, 0.042),
    100px 100px 80px rgba(0, 0, 0, 0.07);
}

.nav {
  width: 80%;
  min-width: 400px;
  margin: auto;
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  background: #fafafa;
}

#name_project {
  font-weight: 700;
}

.containerLogin {
  width: 400px;
  max-width: 95%;
}

.input {
  display: flex;
  flex-direction: column;
  margin-bottom: 15px;
}

.input > label {
  text-align: start;
}

.input > input {
  margin-top: 6px;
  height: 38px !important;
}

/* From uiverse.io */
.btn-pers {
  position: relative;
  left: 50%;
  padding: 1em 2.5em;
  font-size: 12px;
  text-transform: uppercase;
  letter-spacing: 2.5px;
  font-weight: 700;
  color: #000;
  background-color: #fff;
  border: none;
  border-radius: 45px;
  box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease 0s;
  cursor: pointer;
  outline: none;
  transform: translateX(-50%);
}

.btn-pers:hover {
  background-color: #800080;
  box-shadow: 0px 15px 20px rgba(46, 229, 157, 0.2);  
  color: #fff;
  transform: translate(-50%, -7px);
}

.btn-pers:active {
  transform: translate(-50%, -1px);
}

/*  */

.alternative-option {
  text-align: center;
}

.alternative-option > span {
  color: #0d6efd;
  cursor: pointer;
}

#sign_out {
  position: relative;
  left: 50%;
  transform: translateX(-50%);
}
</style>
