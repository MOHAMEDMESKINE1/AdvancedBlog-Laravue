<template>
   
 

   
    <router-view></router-view>
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
