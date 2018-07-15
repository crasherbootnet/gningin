@extends('layouts.dashboard')

@section('title', 'Objextifs')

@section('content')
	<div class="content">
        <div class="container-fluid">
            <div class="row">
				<form action="{{ url('projects/objectifs/'.$project->short_code) }}" method="POST" enctype="multipart/form-data">
					<input type="text" name="_token" value="{{ csrf_token() }}" hidden>
					<textarea rows="12" cols="100" name="content" class="tinymce">
						@if($objectif && $objectif->content)  {{ $objectif->content }} @endif
					</textarea>
					</div>
						<div class="row" style="margin: 10px 0px 0px 0px">
						<a href="{{ url('projects/show/'.$project->short_code) }}" class="btn btn-annuler">annuler</a>
						<button type="submit" class="btn btn-loader pull-right">enregistrer</button>
					</div>		
				</form>
			</div>
	    </div>
	</div>
@endsection