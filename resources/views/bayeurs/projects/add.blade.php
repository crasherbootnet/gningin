@extends('layouts.app')

@section('title', "Création d'un projet")

@section('content')

<style>
	.btn-choose, .btn-choose:hover, .btn-choose:focus{
		border-color: green;
		color: #fff;
		background: green;
	}
</style>
<div class="container">
	<h3 style="text-align: center">Bienvenue dans la création d'un projet</h3>
	<form action="{{ url('projects')}}" method="POST" class="box box-success form">
		<input type="text" name="_token" value="{{ csrf_token() }}" hidden>
		<input type="text" name="categories" hidden>
		<div class="form-group">
				<div class="row">
					<label class="col-md-3" style="text-align: right;padding-top: 10px;">Libelle (*) </label>
					<div class="col-md-6">
						<input type="text" name="libelle" placeholder="Entrer le nom du projet" class="form-control" required>
					</div>
				</div>
		</div>
		<div class="form-group">
			<div class="row">
				<label class="col-md-3" style="text-align: right;padding-top: 10px;">Date début du projet (*) </label>
				<div class="col-md-6">
					<input type="date" name="date_debut" class="form-control" required>
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
		<div class="form-group">
			<div class="row">
				<label class="col-md-3" style="text-align: right;padding-top: 10px;">Type de projet (*) </label>
				<div class="col-md-6">
					<select name="type_projet" id="type_projet" class="form-control" required>
						<option value="">Selectionner le type de projet</option>
						<option value="1">Cadre Logique</option>
						<option value="2">Théorie du Changement</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row" style="margin-bottom: 10px">
			@foreach($categories as $categorie)
				<a href="javascript:void(0)" class="btn btn-primary col-md-2 categorie" data-categorie_id="{{ $categorie->id }}" style="margin-top: 10px; margin-left: 10px;">{{ $categorie->libelle }}</a>
			@endforeach
		</div>
		<div class="row" style="margin: 0px">
			<a href="/" class="btn btn-annuler">annuler</a>
			<button type="submit" class="btn btn-loader pull-right">créer</button>
		</div>	
	</form>
</div>

<script>
	$(document).ready(function() {
		$(".categorie").click(function(){
			$(this).toggleClass('btn-choose', 'btn-primary');
		});

		var categories;
		$("form").submit(function(){
			categories = new Array();
			$(".btn-choose").each(function(e){
				var	categorie_id = $(this).data('categorie_id');
				categories.push(categorie_id);
			});
			$("input[name='categories'").val(JSON.stringify(categories));
		});
	});
</script>
@endsection