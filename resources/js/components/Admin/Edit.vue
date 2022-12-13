<template>
    <!-- edit Modal -->
    <div class="modal fade" id="editPost" tabindex="-1" data-bs-backdrop="static"
    data-bs-keyboard="false"
    role="dialog"
        aria-labelledby="modalTitleId"
        aria-hidden="true">

    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalTitleId">Edit Post</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    <div class="modal-body">
            <form enctype="multipart/form-data">
            
                <!-- <input type="hidden" v-model="PostToEdit.id"> -->
                <!-- title -->
                <div class="form-group">
                <label>title</label>
                <input type="text" name="" class="form-control"  v-model="PostToEdit.title">
                </div>
                <!-- body -->
                <div class="form-group">
                <label>body</label>
                <textarea name=""  cols="30" class="form-control" v-model="PostToEdit.body"
                                rows="10"></textarea>
                </div>
                <!-- category -->
                <div class="form-group">
                <label>category</label>
                <select name="" class="form-control" v-if="PostToEdit.category" v-model="PostToEdit.category.id">
                    <option value="0" disabled selected>choose category</option>

                    <option :value='category.id' v-for="category in categories" :key="category.id"  > 
                            {{category.name}}
                    </option>
                </select>
                </div>
                <!-- image -->
                <div class="form-group">
                <label>image</label>
                <input type="file" 
                @change="onImageChanged"
                class="form-control" >
                </div>
                <small class="mt-3">
                    <img :src="'/assets/img/'+PostToEdit.image" class="rounded-1 rounded" width="80" height="80" alt="">
                </small>
            </form>
    </div>
    <!-- footer -->
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" @click.prevent="updatePost">Save</button>
    </div>

    </div>
</div>
    </div>

</template>

<script>
export default {
   data(){
    return {
        
          categories:[]
        }
   },
    created(){
        this.getCategories()
    },  
    computed : {
        PostToEdit(){
            return this.$store.getters.PostToEdit
        }
    },
    methods: {
        getCategories(){

        axios.get('/api/admin/categories')
        .then(res => {
            this.categories = res.data
            // console.log(res.data)
            })
        },
        onImageChanged(event){
            this.PostToEdit.image=event.target.files[0];
        },
        updatePost(){
                let config = {
                headers : {"content-type":"multipart/from-data"}
                }

                let formdata = new FormData();
                formdata.append('id',this.PostToEdit.id)
                formdata.append('title',this.PostToEdit.title)
                formdata.append('body',this.PostToEdit.body)
                formdata.append('image',this.PostToEdit.image)
                formdata.append('category',this.PostToEdit.category.id)

                axios.post('/api/admin/update',formdata,config)
                .then(res =>{
              
                // this.title=''
                // this.body=''
                // this.image=''
                // this.category=''
                this.PostToEdit.image = res.data.image
                // console.log(res.data)
                })
                .catch(err => console.log(err))

                }
        
   
       
}   }
</script>

<style>

</style>