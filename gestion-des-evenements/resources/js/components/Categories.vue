<template>
    <div class="col-md-4 mt-5">
        <div class="card">
             <h2 class="card-header">categories</h2>
             <div class="card-body">
                 <ul class="list-group">
                   <li class="list-group-item">
                       Sport Event
                   </li>
               </ul>
               <ul class="list-group">
                   <li class="list-group-item">
                       conference
                   </li>
               </ul>
               <ul class="list-group">
                   <li class="list-group-item">
                       Party
                   </li>
               </ul>
             </div>
        </div>

    </div>
</template>
<script>
export default {
    data(){
        return{
            categories : []
        }
    },
    created () {
        axios.get('/api/categories')
            .then(response => this.categories = response.data.categories)
            .catch(err => console.log(err));

    }
}
</script>