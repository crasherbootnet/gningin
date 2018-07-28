@extends('layouts.dashboard')

@section('title', 'Composante')

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
				<!--<a href="{{ url('projects/activites/'.$project->short_code.'/create') }}" class="pull-right btn btn-loader">ajouter</a>-->
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nom</th>
							<th>Date début</th>
							<th>Date fin</th>
							<th>Actions</th>
						</tr>
						
					</thead>
					<tbody>
						@php $i = 1; @endphp
						@foreach($activites as $activite)
							<tr>
								<td>{{ $i }}</td>
								<td><a href="{{ url('projects/'.$project->short_code.'/activites/edit/'.$activite->short_code) }}">{{ $activite->libelle }}</a></td>
								<td>{{ $activite->date_fin }}</td>
								<td>{{ $activite->date_debut }}</td>
								<td class="actions">
									<a href="{{ url('bayeurs/ong/project-activites/show/'.$activite->short_code) }}" class='view'><span><i class='fa fa-eye fa-lg' aria-hidden='true'></i></span></a>
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

	<script type="text/javascript">
		$(document).ready(function(){
			$(".deleted").click(function(){
				$('#modalDeleteActivity').modal();
				$('.btn_delete_activite').attr("data-activite_short_code","/"+$(this).data('activite_short_code'));
				return false;
			});

			$(".btn_delete_activite").click(function(){
				window.location = "{{ url('projects') }}"+"/"+$(this).data('project_short_code')+"/activites/delete"+$(this).data('activite_short_code');
			});
		});
	</script>

@endsection