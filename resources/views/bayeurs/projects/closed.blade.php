@extends('layouts.bayeur')

@section('title', 'Execution')

@section('content')
	<div class="content">
        <div class="container-fluid">
            <div class="row">
				<form method="POST" enctype="multipart/form-data" id="closedForm">
					<input type="text" name="_token" value="{{ csrf_token() }}" hidden>
					<textarea rows="12" cols="100" name="content" class="tinymce">
						
					</textarea>
					<div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group" style="margin-top: 10px">
									<div class="form-group">
										<input type="file" id="input03" class="filestyle" name="file">
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium quod alias cupiditate eveniet qui dolorem voluptatibus aperiam sint. Itaque quo, pariatur impedit dolorem reprehenderit. Ratione totam eos error est, modi!
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium quod alias cupiditate eveniet qui dolorem voluptatibus aperiam sint. Itaque quo, pariatur impedit dolorem reprehenderit. Ratione totam eos error est, modi!
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium quod alias cupiditate eveniet qui dolorem voluptatibus aperiam sint. Itaque quo, pariatur impedit dolorem reprehenderit. Ratione totam eos error est, modi!
						</p>
					</div>
					<div class="row" style="margin: 10px 0px 0px 0px">
						<a href="{{ url('bayeurs/projects/params/'.$project->short_code) }}" class="btn btn-annuler">annuler</a>
						<button type="submit" class="btn btn-loader pull-right">fermer le project</button>
					</div>
				</form>
			</div>
	    </div>
	</div>

	<!-- START MODAL -->
	<div class="modal fade" tabindex="-1" role="dialog" id="ModalConfirmationClosedProject">
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
            <button type="button" class="btn btn-primary" id="btnModdalClosedProject">Block</button>
          </div>
        </div>
      </div>
      </div>
  <!-- END MODAL -->

  <script>
  	$(document).ready(function(){
  		$("#closedForm").submit(function(e){
  			$("#ModalConfirmationClosedProject").modal();
  			return false;
  			//e.preventDefault();
  		});

  		$("#btnModdalClosedProject").click(function(){
  			$.ajax({
  				url : "{{ route('postClosedProject', ['short_code' => $project->short_code ]) }}",
  				type: "POST",
  				data: {"_token": $("input[name='_token']").val(), "short_code": $("input[name='short_code']").val(), 
  					  "content": $("textarea[name='content']").val() },
  				success: function(data){
						// close modal 
						$("#ModalConfirmationClosedProject").modal('toggle');

						if(data == 0){
							alert("Désolé nous ne pouvons pas fermer ce project");
						}else if(data == 1){
							alert("L'opération s'est passé avec success");
						}

						window.location = "{{ url('bayeurs/projects/params/'.$project->short_code) }}"
  				}
  			})
  		});
  	});
  </script>

  <script>
	//init tinyMCE
	tinymce.init({
		selector:"textarea.tinymce",
	  height: 500,
	  theme: 'modern',
	  plugins: [
	    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
	    'searchreplace wordcount visualblocks visualchars code fullscreen',
	    'insertdatetime media nonbreaking save table contextmenu directionality',
	    'emoticons template paste textcolor colorpicker textpattern imagetools'
	  ],
	  toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
	  toolbar2: 'print preview media | forecolor backcolor emoticons',
	  image_advtab: true,
		statubar:true
	});

</script>
@endsection