<template>

    <div class="login-form">
          <form action="" method="post" nonvalidate>
              <h2 class="text-center">Create New Account</h2>
              <div class="form-group">
                  <input type="text" class="form-control" placeholder="name" v-model="name">
                 
                  <small v-if="(name.length<=0|| name.length<4)" class="text-danger">
                    the name is required
                  </small>
                  <small  v-else class="text-success">
                    valid name 
                  </small>
                  
              </div>
          
              <div class="form-group">
                  
                  <input type="email" class="form-control" placeholder="email" v-model="email">
                 
                  <small v-if="(email.length<=0 ||!reg.test(email ))" class="text-danger ">
                    the email is not valid
                  </small>
                  <small  v-else class="text-success">
                    valid email 
                  </small>
                 
              </div>
              <div class="form-group">
                  
                  <input type="password" class="form-control" placeholder="Password" v-model="password">
                 
                  <small v-if="(password.length<4)" class="text-danger">
                    the password is required
                  </small>
                  <small  v-else class="text-success">
                    valid password 
                  </small>
              </div>
              <div class="form-group">
                  
                  <input type="password" class="form-control" placeholder="Confirm Password" v-model="confirmPassword">
                  
                  <small v-if="(password !== confirmPassword)" class="text-danger">
                    the password is not match
                  </small>
                  <small  v-else class="text-success">
                    valid password 
                  </small>
              </div>
             
              <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block"
                    @click.prevent="register"
                    :disabled=" name.length<=0 ||  name.length<4 || !reg.test(  email )|| email.length<=0 || password.length<=4 "
                  >Create Account</button>
              </div>
              <div class="clearfix">
                  <a href="#" class="pull-right">Forgot Password?</a>
              </div>
          </form>
          <p class="text-center">having account ?
             <!-- <strong class="switch-tologin-modal" ><a href="#">Login</a></strong> -->
            
            <router-link class=" text-success  mx-1" :to="{ name: 'loginUser'}">Login</router-link>
       
          </p>

 </div> 


</template>
<!-- 
    :disabled="!isValidForm"
    @click.prevent="submitRegister"
-->
<script>
export default {
    data(){
         return {
             name : '',
             password : '',
             email : '',
             reg:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/,

             confirmPassword:''
            
         }

     },
     mounted(){
        console.log("registered");
     },
    
     methods: {
        register(){
         
            let {name,email,password} = this;

            this.$store.dispatch('registerUser',{name,email,password})
            
            // getters
            //  let user = this.$store.getters.getUserToken;
            //  console.log(user);

            // mutations
            //  this.$store.commit('setUserToken',{
            //   userToken:'pskspmq84444kjls1'
            //  });
            
        },
        isValid(){
          if( this.firstname.length<=0 || this.firstname.length<4 || !reg.test( this.email )||   this.email.length<=0 ||  this.password.length<=4)
           return true 
           
        }
     }
}
</script>

<style>

</style>