<template>
 <div>
    <div class="login-form w-full">
          <form action="" method="post">
              <h2 class="text-center">Log in</h2>
             
              
              <div class="form-group">
                  <input type="email" class="form-control" placeholder="email" v-model="email">
                  <small v-if="(email.length<=0 ||!reg.test(email ))" class="text-danger ">
                    the email is not valid
                  </small><br>
              </div>
              <div class="form-group">
                  <input type="password" class="form-control" placeholder="Password" v-model="password">
                  <small v-if="(password.length<4)" class="text-danger">
                    the password is required
                  </small>
              </div>
              <!-- 
                  :disabled="!isValidForm"
                  @click.prevent="submitLogin"
               -->
              <div class="form-group">
                  <button type="submit"
                  class="btn btn-primary btn-block"
                  @click.prevent="login"
                  :disabled="(password.length<4 ||email.length<=0 ||!reg.test(email ) ) "
                  >Log in</button>
              </div>
              <div class="clearfix">
                  <a href="#" class="pull-right">Forgot Password?</a>
              </div>
          </form>
            <p class="text-center">
                <router-link class=" text-success  mx-1" :to="{ name: 'registerUser'}">Create an Account !!</router-link>
            </p> 
        </div>
 </div>

</template>

<script>
export default {
    data(){
         return {
             email : '',
             password : '',
             reg:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/,
          

         }
     },
     mounted(){
        console.log("login");
     },
     methods: {
        isLogged(){
            return this.$store.getters.isLogged;
        },
        login(){
        
            let {email,password} = this
        //   this.$store.dispatch('loginUser',{email,password})
          
                this.$store.dispatch('loginUser',{email,password})
                this.$router.push('/')
           
           
        }
     }
}
</script>

<style>

</style>