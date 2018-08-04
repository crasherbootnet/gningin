@extends('layouts.historisations.content')

@section('title', 'Cadrelogique')


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
                        <li class="active"><a href="{{ url('projects/historisation-cadre-logique/'.$historisation->id) }}">{{ $historisation->created_at }}</a></li>
                    @else
                        <li><a href="{{ url('projects/historisation-cadre-logique/'.$historisation->id) }}">{{ $historisation->created_at }}</a></li>
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
				<form action="{{ url('bayeurs/projects/historisation-cadrelogique/'.$projectHistorisation->id) }}" method="POST" enctype="multipart/form-data">
					<input type="text" name="_token" value="{{ csrf_token() }}" hidden>
					<textarea rows="12" cols="100" name="content" class="tinymce">
						@if($cadrelogique && $cadrelogique->content)  {{ $cadrelogique->content }} @endif
					</textarea>
					<div class="row" style="margin: 10px 0px 0px 0px">
						<a href="{{ url('bayeurs/projects/historisations-versions/'.$projectHistorisation->short_code) }}" class="btn btn-annuler">annuler</a>
						<button type="submit" class="btn btn-loader pull-right">enregistrer</button>
					</div>
				</form>
			</div>
	    </div>
	</div>
@endsection