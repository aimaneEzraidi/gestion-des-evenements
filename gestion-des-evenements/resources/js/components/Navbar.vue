<template>
    <div>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" >My Events</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <router-link class="nav-link" :to="events">Events</router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link" :to="registre">Inscription</router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link" :to="login" v-if="!logged">Connexion</router-link>
      </li>
      <li class="nav-item">
        <a class="nav-link" @click="userlougout" style="cursor:pointer" v-if="logged">
          <span class="font-weight-boldd">{{name.toUpperCase()}}</span> Deconnexion
        </a>
      </li>
      <li class="nav-item">
        <router-link class="nav-link" :to="adminPanel">Admin Panel</router-link>
      </li>
    </ul>
  </div>
</nav>
    </div>
</template>
<script>
export default {
    data(){
      return{
        home:'/',
        events:'/events',
        login:'/login',
        registre:'/registre',
        logout:'/logout',
        logged : User.isLogged().logged,
        name : User.isLogged().name,
        adminPanel:'/admin'
      }
    },
    methods: {
        userlogout(){
            User.logout();
            this.logged= false;
            this.$router.go();
        }
    }
}
</script>