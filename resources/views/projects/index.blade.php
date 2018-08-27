@extends('layouts.app')

@section('title', 'Liste des Projects')


@section('content')
    <div class="content">
    <div class="container-fluid"  style="margin: 0% 22%;">
        <div class="row" style="margin-bottom: 10px;margin-right: 4px;">
            <h4 class="col-md-8" style="margin: 10px 0px 0px 0px;!important;">Bienvenue dans la liste des projets</h4>
        	<a href="{{ url('projects/create') }}" class="pull-right col-md-2 btn btn-loader">ajouter</a>
        </div>
        <div class="box row">
            	<div>
            		@foreach($projects as $project)
            			<div class="col-md-3">
                            <a href="{{ url('projects/show') }}/{{ $project->short_code }} btn-project-{{$project->short_code}}" id="btn-project-{{$project->short_code}}">
                                <div class="card">
                                    <i class="fa fa-graduation-cap fa-5x" aria-hidden="true"></i>
                                    <label>{{ $project->short_code }}</label>
                                </div>
                            </a>
                        </div>
            		@endforeach
            	</div>
            	
            </div>
        </div>
    </div>
@endsection