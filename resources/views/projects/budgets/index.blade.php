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
                <a href="{{ url('projects/show/'.$project->short_code) }}" class="btn btn-loader">retour</a>
                <div class="row">
                    <div class="col-md-4">
                        Budget : {{ $project->budget() }}
                    </div>
                    <div class="col-md-4">
                    	@if(!$project->isLock() && !$project->isClosed())
                        	<a href="{{ url('projects/activites/'.$project->short_code.'/create') }}" class="pull-right btn btn-loader">ajouter</a>
                        @endif
                    </div>
                </div>
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nom</th>
							<th>Date début</th>
							<th>Date fin</th>
							<th>Budget</th>
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
								@if($activite->budget === null)
                                    <td><a href="javascript:void(0)" class="btn btn-danger add-budget">no</a></td>
                                @else
                                    <td><a href="javascript:void(0)" class="btn btn-primary add-budget">yes</a></td>
                                @endif
								<td class="actions">
									<a href="{{ route('showBudgetActivite', ['short_code' => $activite->short_code]) }}" class='view'><span><i class='fa fa-pencil-square-o fa-lg' aria-hidden='true'></i></span></a>
								</td>
							</tr>
							@php $i+=1 @endphp
						@endforeach
					</tbody>
				</table>
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