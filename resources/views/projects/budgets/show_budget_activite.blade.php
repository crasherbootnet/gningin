@extends('layouts.dashboard')

@section('title', 'Composante')

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
                <a href="{{ url('projects/budget/'.$project->short_code) }}" class="btn btn-loader">retour</a>
                <div class="row">
                    <h4>Budget activite </h4>
                    <div class="form-group">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="budget" id="budget" value="{{  $activite->budget }}">
                            <input type="text" name="_token" value="{{ csrf_token() }}" hidden>
                        </div>
                        <div class="col-md-1">
                            <a href="javascript:void(0)" class="btn btn-primary" id="register-budget">register</a>
                        </div>
                    </div>
                </div>

                @if($activite->budget !== null)
                    <div class="row">
                        <h4>Liste des sous activites</h4>
                        <a href="{{ url('projects/budget/add-sousactivite/'.$activite->short_code) }}" class="pull-right btn btn-loader">ajouter</a>
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Date début</th>
                                        <th>Date fin</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach($activite->sousActivites as $sousactivite)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td><a href="{{ url('projects/budget/show-sousactivite/'.$sousactivite->short_code) }}">{{ $sousactivite->libelle }}</a></td>
                                            <td>{{ $sousactivite->date_fin }}</td>
                                            <td>{{ $sousactivite->date_debut }}</td>
                                            <td class="actions">
                                                <a href="{{ url('projects/budget/edit-sousactivite/'.$sousactivite->short_code) }}" class='view'><span><i class='fa fa-pencil-square-o fa-lg' aria-hidden='true'></i></span></a>
                                                <a href="{{ route('getEditSousActivite', ['shortcode_sousactivite' => $sousactivite->short_code ]) }}" class='edit'><span><i class='fa fa-eye fa-lg' aria-hidden='true'></i></span></a>
                                            </td>
                                        </tr>
                                        @php $i+=1 @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
			</div>
	    </div>
	</div>

    <script type="text/javascript">
		$(document).ready(function(){
			$("#register-budget").click(function(){
                $.ajax({
                    url: '{{ url('projects/register-budget-activite/'.$activite->short_code)}}',
                    type: "POST",
                    data: {"_token": $("input[name='_token']").val(), "budget": $("#budget").val()},
                    success : function(data){
                        if(data == 1){
                            alert("success");
                            window.location = "{{url('projects/budget/show-budget-activite/'.$activite->short_code)}}";
                        }else{
                            alert("error");
                        }
                    }
                });
			});
		});
	</script>
@endsection