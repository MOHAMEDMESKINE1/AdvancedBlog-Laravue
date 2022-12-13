import './bootstrap';

import { createApp } from 'vue';

import router from './routes';
import store from './store';

import Posts from './components/Posts.vue';
import HomeComponent from './components/Home.vue';
import HeaderComponent from './components/Header.vue';
import footerCompoenet from './components/Footer.vue';

// import pagination from 'v-pagination-3';
//  import  * as pagination from 'laravel-vue-pagination' ;






// method 1
const app = createApp({
    components: { 
       Posts ,
       HomeComponent,
    //    pagination,
    HeaderComponent,
    footerCompoenet
    }
    
})

// method 2

// app.component('pagination', pagination);
// app.component('Posts', Posts);
// app.component('Home', Home);
// app.component('register', Register);
// app.component('login', Login);

app.use(router);
app.use(store);
app.mount('#app');
