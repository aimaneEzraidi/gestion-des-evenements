<template>
    <div >        
        <router-view></router-view>  
        <Navbar/>
        
        
        
    
    </div>
      
</template>
<script>
import Navbar from './Navbar.vue';
import Login from './Login.vue';
import Footer from './Footer.vue';


export default {  
    components:{
        Navbar,
        
        
    }

}
</script>