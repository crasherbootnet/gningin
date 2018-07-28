@extends('layouts.dashboard')

@section('title', 'Composante')

@section('content')
	<div class="content">
        <div class="container-fluid">
            <div class="box row">
            	<div class="box-body">
            		<div class="libelle">
	            		<div class="row">
	            			<div class="col-md-6">
	            				<label>Libellé : </label><h2 style="display: inline-block;">{{ $activite->libelle }}</h2>
	            			</div>
	            			<div class="col-md-6">
	            				<label style="display: inline-block;margin-top: 48px;">Date début : {{ $activite->date_debut }} &nbsp;&nbsp;&nbsp; Date fin : {{ $activite->date_fin }}</label>
	            			</div>
	            		</div>
	            	</div>
	            	<div class="description">
	            		<label><h2>Description de l'activité</h2></label>
	            		<div>{{ $activite->content }}</div>
	            	</div>
	            	<!--<div class="rapport_moral">
	            		<label><h2>Rapport moral</h2></label>
	            		<div><?php echo $activite->rapport_moral; ?></div>
	            	</div>
	            	<div class="rapport_financier">
	            		<label><h2>Rapport financier</h2></label>
	            		<div>{{ $activite->rapport_financier }}</div>
	            	</div>
	            	<div class="liste_presence">
	            		<label><h2>Liste de présence</h2></label>
	            		<div class="row">
							<table class="table table-bordered col-md-12" @if($activite->liste_presence == 0) hidden="hidden" @endif>
								<thead>
									<tr>
										<th>Id</th>
										<th>Nom && Prénom</th>
										<th>Fonction</th>
										<th>Contact</th>
										<th>Email</th>
									</tr>
								</thead>
								<tbody>
									@php $i=1; @endphp
									@foreach($activite->personnes() as $personne)
										<tr class='personnes'>
											<td>{{ $i }}</td>
											<td class='name'>{{ $personne->nom_prenom }}</td>
											<td class='fonction'>{{ $personne->fonction }}</td>
											<td class='contact'>{{ $personne->contact }}</td>
											<td class='email'>{{ $personne->email }}</td>
										</tr>
										@php $i+=1; @endphp
									@endforeach
								</tbody>
							</table>
						</div>
	            	</div>-->  
            	</div>
            	<div class="box-footer row" style="margin-top: 20px">            		
					<a href="{{ url('bayeurs/ong/project-activites/'.$project->short_code) }}" class="btn btn-annuler">retour</a>
					<a href="{{ url('projects/'.$project->short_code.'/activites/'.$activite->short_code) }}" class="btn btn-loader pull-right">modifier</a>
            	</div>
			</div>
	    </div>
	</div>
@endsection	