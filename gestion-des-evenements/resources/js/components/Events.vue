<template>
   <div class="container">
       <div class="row my-4">
           <Categories>
           </Categories>
           <div class="col-md-8 mt-5">
               <div class="card">
                   <div class="card-header"><h3>Events</h3></div>
                   <div class="card-body">
                        <div class="media my-4 ">
                            <img style="width:200px;height:200px" src="../images/stade.jpg" class="rounded shadow-sm img-fluid mr-2" alt="">
                            <div class="media-body">
                                <h3>Match de footbal</h3>
                            
                                <p>
                                    <span class="text-default">
                                        admin
                                    </span>
                                </p>
                                <p class="lead">un mtch de football entre barcelona et real madrid</p>
                                <span class="text-default">
                                      Localisation: Madrid espagne <br>
                                      Date: le 24 jan 2020 , 20:00
                                </span>
                            </div>
                            
                        </div>
                         <div class="media my-4">
                            <img style="width:200px;height:200px" src="../images/conference.jpg" class="rounded shadow-sm img-fluid mr-2" alt="">
                            <div class="media-body">
                                
                                <h3>Learn vue js</h3>
                                
                                <p>
                                    <span class="text-default">
                                        admin
                                    </span>
                                </p>
                                <p class="lead">une conference concerne vue js</p>
                                <span class="text-default">
                                      Localisation:  New York USA <br>
                                      Date: le 3 fev 2020 , 16:00
                                </span>
                            </div>
                            
                        </div>
                         <div class="media">
                            <img style="width:200px;height:200px" src="../images/fete.jpg" class="rounded shadow-sm img-fluid mr-2" alt="">
                            <div class="media-body">
                                
                                <h3>Sweet Party</h3>
                                
                                <p>
                                    <span class="text-default">
                                        admin
                                    </span>
                                </p>
                                <p class="lead">une fête de fin d'année</p>
                                <span class="text-default">
                                      Localisation: Mazagan El jadida <br>
                                      Date: le 31 dec 2020 , 21:30
                                </span>
                            </div>
                            
                        </div>

                   </div>
                   <div class="card-footer d-flex justify-content-center">
                       <pagination :data="events" @pagination-change-page="getEvents"></pagination>
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
        getEvents(page){
            if(typeof page === 'undefined'){
                page=1;
            }
            axios.get('/api/events?page=' +page)
            .then(response => {
                console.log(response.data);
                this.events = response.data;
            })
            .catch(err => console.log(err));
        }
    },
}
</script>