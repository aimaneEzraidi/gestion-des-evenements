import Vue from 'vue'
import VueRouter from 'vue-router'

import Home from '../components/Home.vue';
import Events from '../components/Events.vue';
import EventDetails from '../components/EventDetails.vue';

import EventCategory from '../components/EventCategory.vue';
import Login from '../components/Login.vue';
import Registre from '../components/Registre.vue';
import Logout from '../components/Logout.vue';
import AdminPanel from '../components/AdminPanel.vue';

Vue.use(VueRouter)

const routes = [
    {
        path : '/',
        component : Home,
        name:'home'
    },
    {
        path : '/login',
        component : Login,
        name:'login'
    },
    {
        path : '/registre',
        component : Registre,
        name:'registre'
    },
    {
        path : '/logout',
        component : Logout,
        name:'logout'
    },
    {
        path : '/events', 
        component : Events,
        name:'events'
    },
    {
    
        path : '/events/:title' , 
        component: EventDetails,
        name:'eventsDetails'
    },
    {
    
        path : '/events/category:name' , 
        component: EventCategory,
        name:'eventCategory'
    },
    {
    
        path : '/admin' , 
        component:  AdminPanel,
        name:'admin'
    }
];
const router = new VueRouter({
    routes ,
    hashbang: false,
    mode: 'history'
})
export default router;
