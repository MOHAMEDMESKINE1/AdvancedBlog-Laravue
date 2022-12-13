<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Ayat Amine</a>
     

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active d-flex justify-content-start">
         
             <!-- notification -->
            <Notification/>

          </li>
          <li class="nav-item active d-flex justify-content-start">
         
            <router-link class="btn btn-link nav-link " :to="{ name: 'posts'}">Home</router-link>

          </li>
          <li class="nav-item active d-flex justify-content-start" v-if="isLogged">
         
            <router-link class="btn btn-link nav-link " :to="{ name: 'admin'}">Admin</router-link>

          </li>
         
          <li class="nav-item">
            <a class="nav-link" href="index.html">blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Contact</a>
          </li>
          
          <li class="nav-item " v-if="!isLogged">
            <router-link class="btn btn-primary text-white nav-link mb-1" :to="{ name: 'registerUser'}">Register</router-link> 
          </li>

          <li class="nav-item " v-if="!isLogged">
            <router-link class="btn btn-success text-white nav-link  mb-1" :to="{ name: 'loginUser'}">Login</router-link> 
          </li>
          <li class="nav-item" v-if="isLogged">
              <a href=""  class="btn btn-success text-white nav-link   " @click.stop="logout">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  
  </nav>

</template>

<script>
import Notification from './Notification.vue'
export default {
  components : {
    name:"Notifcation",
    Notification
  },
  computed : {
      isLogged(){
        return this.$store.getters.isLogged
      },
      isAdmin(){
        return this.$store.getters.isAdmin
      },
      logout(){
        this.$router.push({name:'posts'})
          return this.$store.commit('logout')
         
      }

    }
}
</script>

<style>

</style>