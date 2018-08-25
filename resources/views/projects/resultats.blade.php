@extends('layouts.dashboard')

@section('title', 'Liste des Projects')

@section('content')
	<style type="text/css">
		tr,td,th{text-align: center;}
	</style>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<form action="{{ url('projects/resultats/'.$project->short_code) }}" method="POST">
					<input type="text" name="_token" value="{{ csrf_token() }}" hidden>
					<div class="row">
						@if(!$project->isLock() || $project->isClosed())
							<a href="" id="ajouter">
								<span>
									<i class=" col-md-12 pull-right fa fa-plus-circle fa-2x" aria-hidden="true"
									   style="padding-top: 10px;margin-right: 2%;margin-bottom: 1%;"></i>
								</span>
							</a>
						@endif
					</div>
					<div class="box">
						<table class="table">
							<thead>
							<tr>
								<th style="width: 5%;">N°</th>
								<th style="width: 20%;">Libelle</th>
								<th>Content</th>
								<th style="width: 10%;">Supprimer</th>
							</tr>
							</thead>
							<tbody id="form-resultat">
							@php $i=1; @endphp
							@if($resultats)
								@foreach($resultats as $resultat)
									<tr class="resultat">
										<td data-id="{{ $resultat->id }}" class="resultat_id">{{ $i }}</td>										
										<td class="libelle">{{ $resultat->libelle }}</td>
										<td class="content">{{ $resultat->content }}</td>
										<td><a href="" class="deleted"><span><i class="fa fa-trash-o" aria-hidden="true"></i></span></a></td>
									</tr>
									@php $i+=1; @endphp
								@endforeach
							@endif
							</tbody>
						</table>
					</div>

					<input type="text" name="resultats" hidden>
					<div class="row" style="margin: 10px 0px 0px 0px">
						<a href="{{ url('projects/show/'.$project->short_code) }}" class="btn btn-annuler">annuler</a>
						<button type="submit" class="btn btn-loader pull-right" @if($project->isLock() || $project->isClosed()) disabled @endif>enregistrer</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" tabindex="-1" role="dialog" id="modalAddResultat">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body" style="margin-left: 10%;">
					<div class="row">
						<div class="form-group row">
							<div class="col-md-8">
								<input type="text" id="libelle" placeholder="libelle" class="form-control" placeholder="Entrer un libelle">
							</div>
						</div>
						<div class="form-group row">
							<!-- <input type="text" id="content" placeholder="content" class="form-control"> -->
							<div class="col-md-8">
								<textarea name="content" cols="30" rows="10" id="content" class="form-control" placeholder="Entrer une description"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Annulez</button>
					<button type="button" class="btn btn-primary" id="ModalAjouter">Ajouter</button>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
        var resultats = new Array();


        $("#ajouter").click(function(e){
            $("#modalAddResultat").modal();
            e.preventDefault();
        });

        $("#ModalAjouter").click(function(e){
            e.preventDefault();
            if(!$("#libelle").val()){
                alert("veillez entrer un libelle");
            }else if(!$("#content").val()){
                alert("veillez entrer un contenu");
            }else{
                var count = $("tr.resultat").length*1+1;
                var content = '<tr class ="resultat"><td>'+count+'</th><td class="libelle">'+$("#libelle").val()+'</td><td class="content">'+$("#content").val()+'</td><td><a href="" class="deleted"><span><i class="fa fa-trash-o" aria-hidden="true"></i></span></a></td></tr>';
                $("#libelle").val("");
                $("#content").val("");
                $("#form-resultat").append(content);
                $("#modalAddResultat").modal('toggle');
            }

        });

        $(document).on('click', '.deleted', function(e) {
            e.preventDefault();
            $(this).parent().parent().remove();
        })

        $(".deleted").click(function(){
            e.preventDefault();
            $(this).parent().parent().remove();
        });

        var form = true;
        $("form").submit(function(){
            if(form){
                $(".resultat").each(function(e){
                    var resultat = {};
                    resultat.libelle = $(this).find(".libelle").text();
                    resultat.content = $(this).find(".content").text();
                    var id = $(this).find(".resultat_id").data('id');
                    resultat.id      = id != null ? id: 0;
                    resultats.push(resultat);
                });
                $("input[name='resultats'").val(JSON.stringify(resultats));
                form = false;
            }
        });
	</script>
@endsection