<template>
<div class="modal fade" id="stampEmployee" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Stamp Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form @submit.prevent="stampTime">
	        <div class="form-group">
			    <label>Name</label>
			    <h5>NAMENAMENAME</h5>
		  	</div>
		  	<div class="form-group">
			    <label>Slug</label>
          <input type="text" class="form-control" v-model="slug">
		  	</div>
		  	<button type="submit" class="btn btn-primary">Stamp</button>
	  	</form>
      </div>
    </div>
  </div>
</div>
</template>
<script>
    export default{
      data(){
        return{
          slug: null
        }
      },
      created(){

      },
      methods: {
        stampTime: function(){
          axios.post('/stamp', {
            slug: this.slug,
            scan: false
          })
          .then(function(res){
            console.log(res.data.employee)
            $('#stampEmployee').modal('hide')
          })
          .catch(function(err){
            console.log(err)
            $('#stampEmployee').modal('hide')
          });
        }
      }
    }
</script>