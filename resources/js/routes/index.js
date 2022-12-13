//   import Vue from 'vue-router'
//   import VueRouter from 'vue-router'

// Vue.use(VueRouter)

import { createRouter,createWebHistory } from "vue-router";


import Posts from '../components/Posts.vue';
import PostDetails from '../components/PostDetails.vue';
import CategoryPosts from '../components/CategoryPosts.vue';
import Register from '../components/Register.vue';
import Login from '../components/Login.vue';
import Admin from '../components/Admin/Admin.vue';
import AllNotifications from '../components/AllNotifications.vue';

const routes = [
    {
        path:'/',
        name:'posts',
        component : Posts
    },
    {
        path:'/post/:slug',
        name:'postDetails',
        component : PostDetails,
        
    },
    {
        path:'/category/:slug/posts',
        name:'categoryPosts',
        component : CategoryPosts,
        
    },
    {
        path:'/registerUser',
        name:'registerUser',
        component : Register,
        
    },
    {
        path:'/loginUser',
        name:'loginUser',
        component : Login,
        
    },
    {
        path:'/admin',
        name:'admin',
        component : Admin,
        
    },
    {
        path:'/allnotifications',
        name:'allnotifications',
        component : AllNotifications,
        
    }
]

const router = createRouter({
    history:createWebHistory(),
    routes

})
export default router;