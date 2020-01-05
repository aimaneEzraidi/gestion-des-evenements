<template>
    <div class="modal fade" id="addEvent" tabindex="-1" role="dialog" aria-labelledby="addEvent" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Ajouter un evenement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form @submit="addEvent"  enctype="multipart/form-data">
                <div class="form-group">
                  <label for="">Category:</label>
                  <br> Veuillez choisir une categorie
                  <select v-model="category" class="form-control" name="category" required >
                    <option v-for="(category,index) in categories" :key="index">
                        {{category.name}}
                    </option>
                    <option value="">
                        
                    </option>
                    <option value="">
                        Conference
                    </option>
                    <option value="">
                        Party
                    </option>
                    <option value="">
                        Sport_Event
                    </option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="">Titre:</label>
                  <input type="text" name="title"  v-model="title" class="form-control" placeholder="Titre" required aria-describedby="helpId">
                </div>
                <div class="form-group">
                  <label for="">Localisation:</label>
                  <input type="text" name="localisation"  v-model="localisation" class="form-control" placeholder="localisation" required aria-describedby="helpId">
                </div>
                <div class="form-group">
                  <label for=""></label>
                  <textarea 
                    v-model="description"
                    class="form-control" 
                    name="description" 
                    rows="5" 
                  placeholder="Description"></textarea>
                </div>
                <div class="form-group">
                  <label for="">Photo:</label>
                  <input type="file" required v-on:change="onImageChange" class="form-control-file" name="image"  placeholder="" aria-describedby="fileHelpId">
                </div>
                <button type="submit" class="btn btn-primary">Valider</button>
          </form>
      </div>
    </div>
  </div>
</div>
</template>
<script>
export default {
    data(){
        return{
            title:"",
            localisation:"",
            description:"",
            category:"",
            categories:[],
            image: null
        }
    },
    created(){
         axios.get('/api/categories')
            .then(response => this.categories = response.data.categories)
            .catch(err => console.log(err));
    },
    methods:{
        onImageChange(e){
            console.log(e.target.files[0]);
            this.image= e.target.files[0];
        },
        addEvent(e){
            e.preventDefault();
            const config = {
                headers : {"content-type": "multipart/form-data"}
            }
            let formData = new FormData();
            formData.append("image",this.image);
            formData.append("title",this.title);
            formData.append("localisation",this.localisation);
            formData.append("description",this.description);
            formData.append("category_id",this.category);
            formData.append("user_id",1);
            axios.post('/api/events',formData,config)
                .then(res => {
                    $('#addEvent').modal('hide');
                     this.title="",
                     this.localisation="";
                     this.description="";
                     this.category="";
                     this.image=null;
                     this.$emit("added");
                }).catch(err => console.log(err));


        }
    }
}
</script>