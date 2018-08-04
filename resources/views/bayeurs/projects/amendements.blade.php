@extends('layouts.bayeur')

@section('title', 'Context')

@section('content')
	<div class="content">
        <div class="container-fluid">
            <div class="row">
				<form action="{{ url('bayeurs/projects/amendements/'.$project->short_code) }}" method="POST">
					<input type="text" name="_token" value="{{ csrf_token() }}" hidden>
					<textarea rows="12" cols="100" name="content" class="tinymce">
						@if($project->projectHistorisation()->amendement) {{ $project->projectHistorisation()->amendement->content }} @endif
					</textarea>
					<div class="row" style="margin: 10px 0px 0px 0px">
						<a href="{{ url('bayeurs/ong/project-follow/'.$project->short_code) }}" class="btn btn-annuler">annuler</a>
						@if(!$project->projectHistorisation()->amendement)<button type="submit" class="btn btn-loader pull-right">enregistrer</button> @endif
					</div>
				</form>
			</div>
	    </div>
	</div>

	<script>
        $(document).ready(function() {
            //init tinyMCE

            tinymce.init({
                selector:"textarea.tinymce",
              height: 500,
              theme: 'modern',
			  readonly: @if($project->projectHistorisation()->amendement) 1 @else 0 @endif,
              plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools'
              ],
              toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
              toolbar2: 'print preview media | forecolor backcolor emoticons',
              image_advtab: true,
                statubar:true
            });
        })
    </script>
@endsection