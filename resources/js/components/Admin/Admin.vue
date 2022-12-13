<template>

  <div class="d-flex justify-content-center ">

    <div class="card text-start shadow ">
       <div class="card-header bg-secondary text-white">
        <h4 class="card-title py-2">Manage Posts</h4>
       </div>
        <div class="card-body">
         
          <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                  
                  <div class="d-flex justify-content-end  mb-2">
                    
                  <!-- Add Modal  button -->
                    <button type="button" 
                    class="btn btn-sm btn-primary mx-1" 
                    data-bs-toggle="modal" 
                    data-bs-target="#addPost">
                      <span>Add New Post</span>
                    </button>
                  <!-- if  Post select button -->
                    <!-- <button type="button" 
                    class="btn btn-sm btn-danger " 
                    data-bs-toggle="modal" 
                    data-bs-target="#deletePost"
                    v-if="selectedPosts.length"
                    >
                      <span>Delete Posts</span>
                    </button> -->
                   <!-- if No Post selected button -->
                   <!-- <button type="button" 
                    class="btn btn-sm btn-danger " 
                    data-bs-toggle="modal" 
                    data-bs-target="#deleteNoPost"
                    v-if="!selectedPosts.length"
                    >
                      <span>Delete Post</span>
                    </button>
                    -->
                  </div>
                </div>
            </div>
            <!-- posts -->
            <table class="table table-striped text-center table-responsive table-hover">
                <thead>
                    <tr>
                        <!-- <th>
                          <span class="custom-checkbox">
                            <input type="checkbox"
                            id="selectAll"
                            @click="selectAll"
                            >
                            <label for="selectAll"></label>
                          </span>
                        </th> -->
                        <th>#</th>
                        <th>Title</th>
                        <th>Body</th>
						            <th>Category</th>
                        <th>Image</th>
                        <th>User</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody v-if="posts.length">
                   <tr  v-for="(post,index) in posts " :key="index">
                      <!-- <td>
                        <span class="custom-checkbox">
                          <input type="checkbox" 
                          :id="'checkbox1'+index"
                          name="" 
                          value="1"
                          @click.stop="selectPost(post,$event)"
                          >
                          <label :for="'checkbox1'+index"></label>
                        </span>
                      </td> -->
                            <td v-text="post.id"></td>
                            <td v-text="post.title"></td>
                            <td v-text="post.body.substr(1,70)"></td>
                      <td>
                          <span class="badge badge-info p-1 mb-1" v-text="post.category.name"></span>
                      </td>
                          <td>
                              <img :src="'assets/img/'+post.image" class="rounded rounded-full" width="70" height="70" style="object-fit:cover;" alt="">
                          </td>
                          <td v-text="post.user.name"></td>
                          <td class=" ">
                            <div class="d-flex ">
                                <!-- view Post -->
                                <router-link class="btn btn-secondary btn sm" :to="{name:'postDetails' ,params:{slug:post.slug}}">View </router-link>
                                <!-- Edit POST  button -->
                                <button @click.prevent="EditPost(post,$event)" type="button" 
                                  class="btn btn-sm btn-success  mx-1" 
                                  data-bs-toggle="modal" 
                                  data-bs-target="#editPost">
                                    <span>Edit </span>
                                  </button>
                                <!-- Delete Modal  button -->
                                  <button type="button"
                                  class="btn btn-sm btn-danger" 
                                 
                                  @click="NormaldDelete(post.id)"
                                  >
                                    <span>Delete </span>
                                  </button>
                            </div>
                              
                          </td>
                    </tr>
                </tbody>
            </table>
        </div>          
        </div>
      </div>
      
       
       <!-- Add Modal  -->
       <div class="modal  fade" id="addPost"
         tabindex="-1" data-bs-backdrop="static"
         data-keyboard="false" 
         data-bs-keyboard="false" role="dialog"
          aria-labelledby="modalTitleId" 
          aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalTitleId">Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  method="post" enctype="multipart/form-data">
                   
                   
                   <!-- title -->
                   <div class="form-group">
                     <label>title</label>
                     <input type="text" class="form-control"  v-model="title">
                   </div>
                   <!-- body -->
                   <div class="form-group">
                     <label>body</label>
                     <textarea name=""  cols="30" class="form-control" v-model="body"
                     rows="10"></textarea>
                   </div>
                   <!-- category -->
                   <div class="form-group">
                     <label>category</label>
                     <select name="" class="form-control" v-model="category">
                         <option value="0" disabled selected>choose category</option>

                         <option v-for="category in categories" :key="category.id"  :value='category.id'> 
                            {{category.name}}
                        </option>
                     </select>
                   </div>
                   <!-- image -->
                   <div class="form-group">
                     <label>image</label>
                     <input type="file" 
                     class="form-control" 
                     @change="onImageChanged"
                     >
                   </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" @click.prevent="addPost">Save</button>
            </div>
          </div>
        </div>
       </div>
       <!-- edit Modal -->
       <EditPost/>
        <!-- delete Modal  -->
        <div class="modal fade" id="deletePost" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Delete Post</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form>                    
                      <p>Are you sure you want to delete these Records?</p>
                      <p class="text-warning"><small>This action cannot be undone.</small></p>
                      <p class="text-warning"><small>Selected Posts : <strong v-text="selectedPosts.length"></strong></small></p>
   				      </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" @click="deletePosts">Delete</button>
              </div>
            </div>
        </div>
       </div>
      
        <!-- No Post selectedModal Modal  -->
        <div class="modal fade" id="deleteNoPost" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header ">
                <h5 class="modal-title d-flex align-items-center" id="modalTitleId">Information <span class="text-success">?</span> </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form>                    
                      <p class="text-primary fw-bold text-center">No Post selected</p>
                      
   				      </form>
              </div>
            </div>
        </div>
       </div>
      
       
     
        
</div>
</template>

<script>
import EditPost from '../Admin/Edit.vue'
export default {  
  components : {
    name:'EditPost',
    EditPost
    },
    data(){
        return {
          title:'',
          body:'',
          image:'',
          category:'',
          posts : [],
          selectedPosts : [],
          categories:[]
        }
    },
    created(){
      this.getPosts()
      this.getCategories()
    },
   
    methods : {

      getPosts(){
        axios.get('/api/admin/posts')
        .then(res => {
          this.posts = res.data
          // console.log(res.data)
        })
      },
      selectPost(post,event){
        
        let index = this.selectedPosts.indexOf(post.id)
        if(index > -1){
          
          this.selectedPosts.splice(index,1)//uncheck
          event.target.checked=false;


        }else{
          
          this.selectedPosts.push(post.id)
          event.target.checked=true;
        }

      },
      selectAll(event){
        if(event.target.checked){

          $('input[type="checkbox"]').prop('checked',true);
          this.posts.data.forEach(p => {
            this.selectedPosts.push(p.id)
          })

        }else{

          $('input[type="checkbox"]').prop('checked',false);
          this.selectedPosts = []
        }
      },
      getCategories(){
        axios.get('/api/admin/categories')
        .then(res => {
           this.categories = res.data
          // console.log(res.data)
        })

      },

      onImageChanged(event){
        console.log(event.target.files[0]);
        this.image=event.target.files[0]
      },

      addPost(){
        let config = {
          headers : {"content-type":"multipart/from-data"}
        }

        let formdata = new FormData();
        formdata.append('title',this.title)
        formdata.append('body',this.body)
        formdata.append('image',this.image)
        formdata.append('category',this.category)

        axios.post('/api/admin/add',formdata,config)
        .then(res =>{
          // console.log(res.data)
          this.title=''
          this.body=''
          this.image=''
          this.category=''
          this.getPosts();
          $('#addPostModal').modal('hide');
				  $('.modal-backdrop').css('display','none')
        })
        .catch(err => console.log(err))

       let modal = document.querySelector('.modal')
        setTimeout(() => {
          modal.style.display="none"
        }, 500);
      },

      // vuex
      EditPost(post){
        return this.$store.commit('EditPost',post)
      },
      NormaldDelete(id){
        if( confirm('Are You Sure ?')){
            axios.delete('/api/admin/NormaldDelete/'+id)
          .then(res => {
          
            this.getPosts();
            console.log(res.data)
          }).catch(err=> console.log(err))

        }
        
      },
      deletePosts(){
        axios.delete('/api/admin/delete/',{posts_ids:this.selectedPosts})
        .then(res => {
          // this.posts = res.data
          // this.getPosts();
           console.log(res.data)
        })
      }
    }
   
  
}
// $(document).ready(function(){
  
// });
</script>

<style>

</style>