<template>
<div>
    <div class="col-md-9">

      <!-- Title -->
      <h1 class="mt-4" v-text="post.title"></h1>

      <!-- Author -->
      <p v-if="post.category" class=" alert alert-info" style="width: fit-content;  padding: 5px;color: #142d31;" 
      v-text="post.category.name">
      </p>

      <hr>

      <!-- Date/Time -->
      <p>Posted on <strong class="badge badge-primary p-1" v-text="post.added_at"></strong>
          <span class="float-right"><strong class="badge badge-info p-1" v-text="comments.length"></strong> Comments </span></p>

      <hr>

      <!-- Preview Image -->
      <img class="img-fluid rounded" :src="'/assets/img/'+post.image" width ='500' alt="image">

      <hr>

      <!-- Post Content -->
      <p class="lead" v-text="post.body"></p>      
      <hr>

      <!-- Comments Form -->
      <div class="card my-4">
        <h5 class="card-header">Leave a Comment:</h5>
        <div class="card-body">
            <input type="hidden" name="" v-model="post_id">
            <div class="form-group">
              <textarea class="form-control" v-model="body" rows="3"></textarea>
            </div>
            <button type="submit" @click.prevent="addComment" class="btn btn-primary">Submit</button>
        </div>
      </div>

      <!-- Single Comment -->
      <div class="media mb-4 comment" v-for="comment in post.comments" :key="comment.id">
        <img class="d-flex mr-3 rounded-circle" 
        :src="'/assets/img/'+comment.user.profile_img" 
        v-if="comment.user.profile_img" width="90"  alt="profile user">
        <div class="media-body">
          <h4 class="text-success" v-text="comment.user.name"></h4>
          <p class="mt-0" v-text="comment.body"></p>
        </div>
      </div>

    

    </div>
</div>
</template>

<script>
import axios from 'axios'
export default {

  data(){
    return {
        post:'',
        body:'',
        post_id:'',
        comments : []
    }
  },

  mounted(){
    this.getPosts();
    this.updateToken();
  },
  computed : {

      isLogged(){
          return this.$store.getters.isLogged
      }
  },
  methods :{
    getPosts(){
          axios.get('/api/posts/'+this.$route.params.slug)
        .then(res=>{
          this.post=res.data 
          this.post_id = this.post.id
          this.comments=this.post.comments
          console.log(res.data);
          // listener pusher
          this.initializeListener()
        })
        .catch(err=> console.log(err))
    },
    addComment(){

      if(this.isLogged){
        let {post_id,body} = this
        axios.post('/api/comment/create',{
          post_id:post_id,
          body:body
        })
        .then(res => {
          console.log(res.data)

          // add comment at first line
          this.comments.unshift(res.data)
          // animation part after adding a comment
          document.querySelectorAll('.comment')[0].classList.add('new')
          // remove animation for other old comments
          document.querySelectorAll('.comment').forEach(item=> item.classList.remove('new'))
        
          
          // get posts 
          this.getPosts();
        })
      }else{
        alert('your not logged')
      }
     
      

    },
    updateToken(){
      
      let userToken = JSON.parse(localStorage.getItem('userToken'))
    
      this.$store.commit('setUserToken',userToken);
    },

    initializeListener(){
        Echo.private(`NewComment.${this.post_id}`)
        .listen(`NewComment`,(e)=>{
          console.log(e);
          this.comments.unshift(e.comment)
          console.log('listen to newComment event');
        })
    }
  }
}
</script>

<style>
.comment{
  padding:0.5rem;
  background: #fff;
}
.comment.new{
  background-color: #fff;
  animation-name: newComment;
  -webkit-animation-name: newComment;
  animation-duration: 6s;
  -webkit-animation-duration: 6s;
  animation-iteration-count: 1;
  -webkit-animation-iteration-count: 1;
}
@keyframes newComment {
  from {background-color: rgb(119, 223, 171);}
  to{background-color: inherit;}
}
</style>