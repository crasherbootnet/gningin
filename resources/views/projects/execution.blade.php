@extends('layouts.dashboard')

@section('title', 'Execution')

@section('content')
	<div class="content">
        <div class="container-fluid">
            <div class="row">
				<form action="{{ url('projects/execution/'.$project->short_code) }}" method="POST" enctype="multipart/form-data">
					<input type="text" name="_token" value="{{ csrf_token() }}" hidden>
					<textarea rows="12" cols="100" name="execution" class="tinymce">
						@if($execution && $execution->exectution)  {{ $execution->execution }} @endif
					</textarea>
					<div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group" style="margin-top: 10px">
									<div class="form-group">
										<input type="file" id="input03" class="filestyle" name="file">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row" style="margin: 10px 0px 0px 0px">
						<a href="{{ url('projects/show/'.$project->short_code) }}" class="btn btn-annuler">annuler</a>
						<button type="submit" class="btn btn-loader pull-right" @if($project->isLock() || $project->isClosed()) disabled @endif>enregistrer</button>
					</div>
				</form>
			</div>
	    </div>
	</div>
@endsection