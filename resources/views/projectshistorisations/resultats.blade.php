@extends('layouts.historisations.content')

@section('title', 'Resultat')


@section('sidebar')
<ul id="sidebarnav">
    <li> 
        <a class="has-arrow waves-effect waves-dark" href="{{ url('bayeurs/projects/historisation-cadrelogique/'.$projectHistorisation->id) }}" aria-expanded="false">
            <i class="mdi mdi-widgets"></i>
            <span class="hide-menu">Derniere version ({{ $projectHistorisation->created_at }})</span>
        </a>
    </li>

    @foreach($projectshistorisations as $projectHist)
        <li class="active"> 
            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                <i class="mdi mdi-gauge"></i>
                <span class="hide-menu">{{ $projectHist->month }}</span>
            </a>
            <ul aria-expanded="false" class="collapse">
                @foreach($projectHist->projectshistorisations as $historisation)
                    @if($projectHistorisation->id == $historisation->id)
                        <li class="active"><a href="{{ url('projects/historisation-resultats/'.$historisation->id) }}">{{ $historisation->created_at }}</a></li>
                    @else
                        <li><a href="{{ url('projects/historisation-resultats/'.$historisation->id) }}">{{ $historisation->created_at }}</a></li>
                    @endif
                @endforeach
            </ul>
        </li>
        <li class="nav-devider"></li>
    @endforeach
</ul>
@endsection

@section('content')
		<style type="text/css">
		tr,td,th{text-align: center;}
	</style>
	<div class="content">
        <div class="container-fluid">
            <div class="row">
				<form action="" method="POST">
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
										<td>{{ $i }}</td>
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
						<a href="{{ url('bayeurs/projects/historisations-versions/'.$projectHistorisation->short_code) }}" class="btn btn-annuler">annuler</a>
					</div>	
				</form>
			</div>
	    </div>
	</div>

	<script type="text/javascript">
		var resultats = new Array();

		$("#ajouter").click(function(e){
			e.preventDefault();
			if(!$("#libelle").val()){
				alert("veillez entrer un libelle");
			}else if(!$("#content").val()){
				alert("veillez entrer un contenu");
			}else{
				var count = $("tr.resultat").length*1+1;
				var content = '<tr class="resultat"><td>'+count+'</th><td class="libelle">'+$("#libelle").val()+'</td><td class="content">'+$("#content").val()+'</td><td><a href="" class="deleted"><span><i class="fa fa-trash-o" aria-hidden="true"></i></span></a></td></tr>';
				$("#libelle").val("");
				$("#content").val("");
				$("#form-resultat").append(content);
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
					resultats.push(resultat);
				});
				$("input[name='resultats'").val(JSON.stringify(resultats));
				form = false;
			}
		});
	</script>
@endsection