<template>

<router-view v-slot="{Component}">
    <transition name="route" mode="out-in">
      <component  :is="Component"></component>
    </transition>
  </router-view>
</template>

<script>
    export default {
     

        created(){
            this.updateToken()
            this.setUser()
            this.isLogged
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            updateToken(){
                
                let userToken = JSON.parse(localStorage.getItem('userToken'))
                
                this.$store.commit('setUserToken',userToken);
                
            },
            setUser(){
                if(this.isLogged){
                    // get user data 
                    axios.get('/api/user')
                    .then(res => this.$store.commit('setUser',res.data.user))
                }
                   
            },
            isLogged(){
                     return this.$store.getters.isLogged
            }
        }
    }
</script>
<style>
/* route transition */
.route-enter-from{
  opacity:0;
  transform: translateX(100px);
}
.route-enter-active{
  transition: all 0.3s ease-out;
}
.route-leave-to {
  opacity: 0;
  transform: translateX(-100px);
}
.route-leave-active{
  transition: all 0.3s ease-in;

}
</style>