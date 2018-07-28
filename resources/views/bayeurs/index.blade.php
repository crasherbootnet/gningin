@extends('layouts.bayeur')

@section('title', 'Bayeur')

@section('content')
		<style type="text/css">
		table, td, tr, th{
			text-align: center;
		}

		.actions a{
			margin-right: 10px;
		}

		fieldset{
		width: 250% !important;
	}

	.modal-header{
		border-bottom: none;
	}
	</style>


	<div class="content">
        <div class="container-fluid">
            <div class="box row">
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Libelle</th>
							<th>Détails</th>
							<th>Actions</th>
						</tr>
						
					</thead>
					<tbody>
						@php $i = 1; @endphp
						@foreach($projects as $project)
							<tr>
								<td>{{ $i }}</td>
								<td>{{ $project->libelle }}</td>
								<td><a href="{{ url('bayeurs/ong/'.$project->ong->id.'/projects/details/'.$project->short_code) }}" class="detail btn btn-primary">{{ $project->short_code }}</a></td>
								<td class="actions">
									<a href="{{ url('bayeurs/ong/project-follow/'.$project->short_code) }}" class='edit btn btn-primary'>Suivre</a>
								</td>
							</tr>
							@php $i+=1 @endphp
						@endforeach
					</tbody>
				</table>
				<ul>
				</ul>
			</div>
	    </div>
	</div>

  	<script>
		$(document).ready(function(){
			/*$(".status").click(function(e){
				e.preventDefault();
				//$("#modalChangeStatutUser").modal();

				// get status
				if($(this).hasClass('btn-danger')){
					var button = $(this);
					$.ajax({
						url: "{{ url('/bayeurs/project/changed-statut')}}",
						data: {'user_id': $(this).data('user_id'), 'statut': 1},
						success: function(data){
							if(data == 1){
								button.removeClass('btn-danger').addClass('btn-primary').text('enabled');
							}
						}
					});
				}else{
					var button = $(this);
					$.ajax({
						url: "{{ url('/bayeurs/project/changed-statut')}}",
						data: {'user_id': $(this).data('user_id'), 'statut': 0},
						success: function(){
							if(data == 1){
								button.removeClass('btn-primary').addClass('btn-danger').text('disbaled');
							}
						}
					});
				}
			});*/
		});
	</script>

@endsection