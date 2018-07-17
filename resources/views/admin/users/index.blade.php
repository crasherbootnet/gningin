@extends('layouts.admin')

@section('title', 'Admin')

@section('content')
		<style type="text/css">
		table, td, tr, th{
			text-align: center;
		}

		.actions a{
			margin-right: 10px;
		}

		fieldset{
		width: 250% !important;
	}

	.modal-header{
		border-bottom: none;
	}
	</style>


	<div class="content">
        <div class="container-fluid">
            <div class="box row">
				<a href="{{ url('/admin/users/create') }}" class="pull-right btn btn-loader">ajouter</a>
				<table class="table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nom</th>
							<th>Email</th>
							<th>Statut</th>
							<th>Actions</th>
						</tr>
						
					</thead>
					<tbody>
						@php $i = 1; @endphp
						@foreach($users as $user)
							<tr>
								<td>{{ $i }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>
									@if($user->active == 0)
										<a href="{{ url('/admin/users/status/'.$user->id) }}" class='status btn btn-danger' data-status="0" data-user_id="{{ $user->id }}">disbaled</a>
									@else
										<a href="{{ url('/admin/users/status/'.$user->id) }}" class='status btn btn-primary' data-status="1" data-user_id="{{ $user->id }}">enabled</a>
									@endif
								</td>
								<td class="actions">
									<a href="{{ url('/admin/users/show/'.$user->id) }}" class='edit'><span><i class='fa fa-eye fa-lg' aria-hidden='true'></i></span></a>
									<a href="{{ url('/admin/users/delete/'.$user->id) }}" class='deleted'><span><i class='fa fa-trash-o  fa-lg' aria-hidden='true'></i></span></a>
								</td>
							</tr>
							@php $i+=1 @endphp
						@endforeach
					</tbody>
				</table>
				<ul>
				</ul>
			</div>
	    </div>
	</div>

  	<script>
		$(document).ready(function(){
			$(".status").click(function(e){
				e.preventDefault();
				//$("#modalChangeStatutUser").modal();

				// get status
				if($(this).hasClass('btn-danger')){
					var button = $(this);
					$.ajax({
						url: "{{ url('/admin/users/changed-statut')}}",
						data: {'user_id': $(this).data('user_id'), 'statut': 1},
						success: function(){
							button.removeClass('btn-danger').addClass('btn-primary').text('disbaled');
						}
					});
				}else{
					var button = $(this);
					$.ajax({
						url: "{{ url('/admin/users/changed-statut')}}",
						data: {'user_id': $(this).data('user_id'), 'statut': 0},
						success: function(){
							button.removeClass('btn-primary').addClass('btn-danger').text('enabled');
						}
					});
				}
			});
		});
	</script>

@endsection