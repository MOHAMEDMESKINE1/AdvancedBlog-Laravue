<template>
    <div class="row">
        <div class="col-md-8">
            <div class="media simple-post " v-for="post in posts" :key="post.id">
                <img class="mr-3" :src="'/assets/img/'+post.image" alt="Generic placeholder image">
                <div class="media-body">
                   <h4>
                    <router-link class="mt-0" :to="{name:'postDetails', params : {slug:post.slug}}" v-text="post.title"></router-link>
                   </h4>
           
                    <p v-text="post.body.substr(0,150)"></p>
                    <ul class="list-inline list-unstyled d-flex post-info">
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
       <div class="col-md-4">
        <div class="card my-4">
              <h5 class="card-header">Search</h5>
              <div class="card-body">
                <div class="input-group">
                  <input type="text" class="form-control" v-model="searchPost" placeholder="Search for...">
                  <span class="input-group-btn">
                    <!-- <button class="btn btn-secondary" type="button">Go!</button> -->
                  </span>
                </div>
              </div>
        </div>
       
        <!-- categories -->
      
    
    
       </div>
    </div>
    </template>
    
<script>
    import axios from 'axios'
    export default {
     
        data(){
            return {
                searchPost:'',
                posts:[]
            }
        },
        mounted(){
            this.getPosts();
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
    methods : {
                getPosts(){
                        axios.get(`/api/category/${this.$route.params.slug}/post`)
                        .then(response =>this.posts =response.data)
                        .catch(err=> console.log(err))
                }
        }
    }
    </script>
    
<style>

</style>