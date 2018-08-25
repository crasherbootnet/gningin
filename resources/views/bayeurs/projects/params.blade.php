@extends('layouts.bayeur')

@section('title', 'Cible')

@section('content')
	<div class="content">
        <div class="container-fluid">
            <div class="row">
            	@if(!$project->isClosed())
	            	<div class="col-md-2">
		            	@if(!$project->verouilleProject || ($project->verouilleProject && ($project->verouilleProject->dateverouille && $project->verouilleProject->datedeverouille)))
							<a href="javascript:void(0)" class="btn btn-primary" id="callModalBlockOrDeblockProject">verouillé</a>
						@else
							<a href="javascript:void(0)" class="btn btn-primary" id="callModalBlockOrDeblockProject">dévérouillé</a>
						@endif
					</div>
				@endif
				
				<div class="col-md-2">
					@if($project->isClosed())
						<a href="javascript:void(0)" class="btn btn-warning">Project closed</a>
					@else
						<a href="{{ route('getClosedProject', ['short_code' => $project->short_code]) }}" class="btn btn-danger"> closed project </a>
					@endif
				</div>

				<div class="col-md-2">
					@if($project->statut_project_id == 2)
						<a href="javascript:void(0)" class="btn btn-warning">Ferme le Project</a>
					@else
						<a href="{{ route('getFinancedProject', ['short_code' => $project->short_code]) }}" class="btn btn-danger"> closed project </a>
					@endif
				</div>
			</div>
	    </div>
	</div>
	
	<!-- START MODAL -->
	<div class="modal fade" tabindex="-1" role="dialog" id="ModalBlockOrDeblockProject">
      <div class="modal-dialog" role="document">
        <input type="text" name="_token" value="{{ csrf_token() }}" hidden>
        <div class="modal-content">
          <div c0lass="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Saisir le nom de la modification ?</h4>
      </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <input type="text" class="form-control" name="short_code" placeholder="Entrer le shoort code du project">
              </div>
            </div>
          </div>
          <div class="modal-footer">
          	<a href="javascript:void(0)" class="btn btn-danger" data-dismiss="modal">Cancel</a>
            <button type="button" class="btn btn-primary" id="btnModdalBlockOrDeblockProject">Block</button>
          </div>
        </div>
      </div>
  </div>
  <!-- END MODAL -->

	<script>
		$(document).ready(function(){
			$("#callModalBlockOrDeblockProject").click(function(){
				$("#ModalBlockOrDeblockProject").modal();
			})

			$("#btnModdalBlockOrDeblockProject").click(function(){
				$.ajax({
					url : "{{ url('bayeurs/verouilleOrDeverouille-projects') }}",
					type : 'GET',
					data : {"short_code" : $("input[name='short_code']").val() },
					success : function(data){

						// close modal 
						$("#ModalBlockOrDeblockProject").modal('toggle');

						if(data == 0){
							alert("Désolé nous ne pouvons pas vérouillé ce projet");
						}else if(data == 1){
							alert("L'opération s'est passé avec success");
						}

						window.location = "{{ url('bayeurs/projects/params/'.$project->short_code) }}"
					}
				})
			});
		});
	</script>
@endsection