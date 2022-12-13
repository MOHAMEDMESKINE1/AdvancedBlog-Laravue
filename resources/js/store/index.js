
import axios from 'axios';
import { createStore } from 'vuex'
import router from '../routes'

const store =createStore({

    state: {
        
        userToken :null,
        user : null,
        Editedpost:{},
        notifications : []
       
                
    },
    getters: {
        isLogged(state){
            return !!state.userToken;
        },
        isAdmin(state){
             if(state.user){
                return state.user.is_admin
            }
           
        },
        PostToEdit(state){
            return state.Editedpost
        }
       
    },
    mutations: {
        setUserToken(state,userToken){
            state.userToken = userToken;
            localStorage.setItem('userToken',JSON.stringify(userToken))
            
            // get the token value from axios headers
            axios.defaults.headers.common.Authorization = `Bearer ${userToken}`
        },
        removeUserToken(){
            state.userToken = null
            localStorage.removeItem('userToken')
        },
        setUser(state,user){
            state.user = user;
            Echo.connector.pusher.config.auth.headers.Authorization = `Bearer ${state.userToken}`;
            Echo.private('App.User.' + state.user.id)
                .notification((notification) => {
                    console.log('notif', notification);
                    state.notifications.unshift(notification)
                });
        },
        logout(){
            localStorage.clear();
            this.$router.push({name:'posts'})
         
        },
        EditPost(state,post){
            state.Editedpost=post
        }
        // getCategories(state){
        //     axios.get('/api/admin/categories')
        //     .then(res => {
        //           state.categories = res.data
        //          console.log(res.data)
        //       })
        // }
       
       
    },
    actions : {

        registerUser({commit},payload){
            
            // register user 
            axios.post('/api/register',payload)
            .then(res =>{
                console.log(res.data.token)
                commit('setUserToken',payload)
            })
            .catch(err=> console.log(err))
        },
        loginUser({commit},payload){        
                // login
                axios.post('/api/login',payload)
                .then(res => {
                    console.log(res.data)
                    commit('setUserToken',res.data.token)
                    
                    // get user data 
                    axios.get('/api/user')
                    .then(res => commit('setUser',res.data.user))
                   
                })
                .catch(err=> console.log(err))
           
           
        }
        
    }
})
export default store