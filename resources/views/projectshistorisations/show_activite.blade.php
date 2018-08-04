@extends('layouts.historisations.content')

@section('title', 'Liste des Projects')


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
                        <li class="active"><a href="{{ url('projects/historisation-activites/'.$historisation->id) }}">{{ $historisation->created_at }}</a></li>
                    @else
                        <li><a href="{{ url('projects/historisation-activites/'.$historisation->id) }}">{{ $historisation->created_at }}</a></li>
                    @endif
                @endforeach
            </ul>
        </li>
        <li class="nav-devider"></li>
    @endforeach
</ul>
@endsection

@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row">
            <div class="col-md-12">
                <h2>Libelle</h2>
                <p>{{$activite->libelle}}</p>
            </div>

            <div class="col-md-12">
                <h2>Content</h2>
                <p>{{$activite->content}}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <a href="{{ url('projects/historisation-activites/'.$activite->project_historisation_id) }}" class="btn btn-primary">Retour</a>
            </div>
        </div>
	</div>
@endsection