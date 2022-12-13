<template>
<div class="row">
    <div class="col-md-8" v-if="isSearching">
        ...searching for  post
    </div>
    <!-- post -->
    <div class="col-md-8" v-else>
        <div class="media simple-post bg-white shadow-sm" v-for="post in posts" :key="post.id">
            <img class="mr-3" :src="'assets/img/'+post.image" alt="Generic placeholder image">
            <div class="media-body">
               <h4>
                <router-link class="mt-0" :to="{name:'postDetails', params : {slug:post.slug}}" v-text="post.title"></router-link>
               </h4>
       
                <p v-text="post.body"></p>
                <ul class="list-inline list-unstyled d-flex post-info bg-white">
                    <li><span><i class="fa fa-user"></i> posted by : <strong class="text-primary" v-if="post.user" v-text="post.user.name"></strong> </span></li>
                    <li>|</li>
                    <li><span><i class="fa fa-calendar" v-text="post.added_at"></i>   </span></li>
                    <li>|</li>
                    <span v-if="(post.comments_count <2)">
                        <i class="fa fa-comment" v-text="post.comments_count"></i>
                        comment
                    </span>
                    <span v-else>
                        <i class="fa fa-comment" v-text="post.comments_count"></i>
                        comments
                    </span>
                </ul>   
            </div>
        </div>
    </div>
    <!-- search -->
   <div class="col-md-4">
    <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for..." v-model="searchPost">
          
            </div>
          </div>
         
    </div>
    <login></login>
     <!--pagination -->
     
    <!-- categories components -->
    <categories/>
    

   </div>

        <!-- <pagination :data="posts" @pagination-change-page="getPosts"></pagination> -->
        
       
</div>
</template>

<script>


import axios from 'axios'
import categories from './Categories.vue';
export default {
    components : {
        categories,
    },
    data(){
        return {
            posts:{},
            isSearching:false,
            searchPost:''
           
        }
    },
    watch:{
        searchPost(query){
           if(query.length >0){

                this.isSearching = true;

                axios.get('/api/searchPosts/'+query)
                .then(res => {
                this.posts =res.data              
                })
                .catch(err => console.log(err))

                console.log(query);
           }else{
            
                let oldPosts = JSON.parse(localStorage.getItem('posts'))
                // this.posts = oldPosts;
                    this.getPosts();
           }
                this.isSearching = false;

        }
    },
    mounted(){
        this.getPosts();
    },
    methods : {
            // getPosts(page){
            getPosts(){
                    // axios.get("/api/posts?page="+page)
                    axios.get("/api/posts")
                    .then(response =>{
                        this.posts =response.data
                        localStorage.setItem('posts',JSON.stringify(this.posts))
                    })
                    .catch(err=> console.log(err))
            }
    }
}
</script>

<style>

</style>