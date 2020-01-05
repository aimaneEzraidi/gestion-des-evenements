<template>
   <div class="container">
       <div class="row my-4">
           <Categories></Categories>
           <div class="col-md-8 mt-5">
               <div class="card">
                   <div class="card-header">Events</div>
                   <div class="card-body"
                        v-for="(event,index) in events"
                        :key="index"
                   >
                        <div class="media">
                            <img style="width:200px;height:200px" :src="event.photo" class="rounded shadow-sm img-fluid mr-2" alt="">
                            <div class="media-body">
                                <router-link :to="event.path">
                                <h3>{{event.title}}</h3>
                                </router-link>
                                <p>
                                    <span class="text-default">
                                        {{event.user.name}}
                                    </span>
                                    <span class="text-danger">
                                        {{event.added}}
                                    </span>
                                </p>
                                <p class="lead">{{event.description.substr(0,200)}}...</p>
                                <span class="text-default">
                                      Localisation:  {{event.localisation}}
                                </span>
                            </div>
                        </div>

                   </div>

               </div>

           </div>

       </div>

   </div>
</template>
<script>
    import Categories from './Categories.vue';
export default {
    data(){
        return{
            events: {}
        }
    },
    components:{
        Categories
    },
    created(){
        this.getEvents();
    },
    methods:{
        getEvents(){
            axios.get(`/api/events/category/${this.$route.params.name}`)
            .then(response => {
                console.log(response.data);
                this.events = response.data;
            })
            .catch(err => console.log(err));
        }
    },
    watch:{
        '$route' : 'getEvents'
    },
}
</script>