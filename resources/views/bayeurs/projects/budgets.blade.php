@extends('layouts.bayeur')

@section('title', 'Cible')

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
								<td>{{ $activite->budget }} FCFA</td>
								<td class="actions">
									<a href="{{ url('bayeurs/ong/project-activites/show/'.$activite->short_code) }}" class='view'><span><i class='fa fa-eye fa-lg' aria-hidden='true'></i></span></a>
								</td>
							</tr>
							
							<!-- Sous activites -->
							@php $j = 1; @endphp
							@foreach($activite->sousactivites as $sousactivite)
								<tr>
									<td>{{ $j }}</td>
									<td><a href="{{ url('projects/'.$project->short_code.'/activites/edit/'.$activite->short_code) }}">{{ $activite->libelle }}</a></td>
									<td>{{ $activite->date_fin }}</td>
									<td>{{ $activite->date_debut }}</td>
									<td>{{ $activite->budget }} FCFA</td>
									<td class="actions">
										<a href="{{ url('bayeurs/ong/project-activites/show/'.$activite->short_code) }}" class='view'><span><i class='fa fa-eye fa-lg' aria-hidden='true'></i></span></a>
									</td>
								</tr>
								@php $j+=1 @endphp
							@endforeach
							<!-- Sous activites -->

							@php $i+=1 @endphp
						@endforeach
					</tbody>
				</table>
				<ul>
				</ul>
			</div>
	    </div>
	</div>
@endsection