<template>
   <div class="card my-4">
          <h5 class="card-header">Categories</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                
                <ul class="list-unstyled mb-0" v-if="categories.length >0 " ><!-- check if categories exist -->
                  <li v-for="category in categories" :key="category.id">
                        <router-link :to="{name:'categoryPosts',params:{slug:category.slug}}" v-text="category.name"></router-link>
                  </li>
                 
                </ul>
              </div>
             
            </div>
          </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {

    data (){
        return {
            categories : []
        }
    },
    created(){
        this.getCategories()
    },
    methods : {
        getCategories(){
            axios.get('/api/categories')
            .then(res=>{
                this.categories = res.data
                console.log(res.data);
            })
            .catch(err=> console.log(err))
        }
    }
}
</script>

<style>

</style>