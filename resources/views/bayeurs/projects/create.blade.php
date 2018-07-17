@extends('layouts.bayeur')

@section('title', "Création d'un projet")

@section('content')
<div>
	<h3 style="text-align: center">Bienvenue dans la création d'un projet</h3>
	<form action="{{ url('bayeurs/projects/store')}}" method="POST" class="box box-success">
		<input type="text" name="_token" value="{{ csrf_token() }}" hidden>
		<div class="form-group">
			<div class="row">
				<label class="col-md-3" style="text-align: right;padding-top: 10px;">Libelle (*) </label>
				<div class="col-md-6">
					<input type="text" name="libelle" placeholder="Entrer le nom du projet" class="form-control">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label class="col-md-3" style="text-align: right;padding-top: 10px;">Date début du projet (*) </label>
				<div class="col-md-6">
					<input type="date" name="date_debut" class="form-control">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label class="col-md-3" style="text-align: right;padding-top: 10px;">Date Fin du projet (*) </label>
				<div class="col-md-6">
					<input type="date" name="date_fin" class="form-control">
				</div>
			</div>
		</div>
		<div class="row" style="margin: 0px">
			<a href="{{ url('bayeurs/projects') }}" class="btn btn-annuler">annuler</a>
			<button type="submit" class="btn btn-loader pull-right">créer</button>
		</div>	
	</form>
</div>
@endsection