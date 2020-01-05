<template>

    <div class="container ">
         <div class="row mt-5 mb-3">
            <div class="col-md-12">
                <a data-target="#addEvent" data-toggle="modal" class="btn mt-5 btn-sm btn-success text-white mb-2">
                     <i class="fa fa-plus"></i>
                </a>
                <table class="table">
                    <thead>
                         <tr>
                            <th>Id</th>
                            <th>Category</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Localisation</th>
                            <th>Ajouter par</th>
                             <th>Le</th>
                            <th>Action</th>
                         </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(event,index) in events.data" :key="index">
                            <td>{{event.id}}</td>
                            <td>{{event.category.name}}</td>
                            <td>{{event.title}}</td>
                            <td>{{event.description.substr(0,100)}}...</td>
                            <td>
                                <img :src="event.photo" 
                                class="img-fluid mr-2 rounded shadow-sm"
                                alt="" 
                                height="60" width="60">
                            </td>
                            <td>{{event.localisation}}</td>
                            <td>{{event.user.name}}</td>
                            <td>{{event.added}}</td>

                        </tr>
                    </tbody>
                </table>
                <div class="card-footer d-flex justify-content-center">
                     <pagination :data="events" @pagination-change-page="getEvents"></pagination>
                 </div>

             </div>
             <AddEvent @added="eventAdded"/>
        </div>
    </div>

</template>
<script>
import AddEvent from'./AddEvent';
export default {
     data(){
        return{
            events:{},
            loading : true 
        }
     },
     components:{AddEvent},
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
        },
        eventAdded(){
            this.getEvents();
        }
     }
}
</script>