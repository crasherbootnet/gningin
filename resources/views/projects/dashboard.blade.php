@extends('layouts.dashboard')

@section('title', 'Liste des Projects')


@section('content')
<div class="content">
	<div class="container-fluid">
		<div class="row">
		<style type="text/css">
	            	.info-box {
					    display: block;
					    min-height: 90px;
					    background: #fff;
					    width: 100%;
					    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
					    border-radius: 2px;
					    margin-bottom: 15px;
					}

					.info-box-content {
					    padding: 5px 10px;
					    height: 124px;
					}


					.info-box-text {
					    text-transform: uppercase;
					    padding-top: 30px;
					}

					.progress-description, .info-box-text {
					    display: block;
					    font-size: 14px;
					    white-space: nowrap;
					    overflow: hidden;
					    text-overflow: ellipsis;
					}


					.info-box-number {
					    display: block;
					    font-weight: bold;
					    font-size: 18px;
					}

					.info-box small {
					    font-size: 14px;
					}
	            </style>


	            <style type="text/css">
					.panel-heading {
					    display: block;
					    position: relative;
					    margin: 2px 0 0 0;
					    padding: .5em .5em .5em .7em;
					    font-size: 100%;
					}

					.panel-heading{
					    border: 1px solid #003eff;
					    background: #007fff;
					    font-weight: normal;
					    color: #ffffff;
					}

					.panel-body{
					    padding: 1em 2.2em;
					    border-top: 0;
				    	overflow: auto;
					}

					.panel-body {
					    border: 1px solid #dddddd;
					    background: #ffffff;
					    color: #333333;
					}

					.panel-body {
					    margin: 0;
					    padding: 1em 2.2em;
					    border: 0;
					    outline: 0;
					    line-height: 1.3;
					    text-decoration: none;
					    font-size: 100%;
					    list-style: none;
					}

					p {
					    font-size: 16px;
					    line-height: 1.5;
					    -webkit-font-smoothing: antialiased;
					    font-family: "Roboto","Helvetica Neue",Arial,sans-serif;
					    font-weight: 400;
					}
				</style>

				<div class="group" style="margin-left:10px">
					<div class="panel-heading header" style="font-size: 16px;">
						<span>INFORMATION SUR LE PROJET</span>
						<span class="collapsed-indicator pull-right fa fa-minus" style="cursor:pointer"></span>
					</div>
					<div class="panel-body" style="display: block">
						<p>
							<div class="row">
								<a class="col-md-3 col-sm-6 col-xs-12" href="{{ url('projects/context') }}/{{ $project->short_code }}">
							        <div class="info-box">
							            <span class="info-box-icon bg-red"></span>

							            <div class="info-box-content">
							              <span class="info-box-text">Context</span>
							            	@if($project->context)
							            		<i class="fa fa-check fa-lg" style="color:green"></i>	
							            	@endif
							            </div>
							        </div>
							    </a>
							    <a class="col-md-3 col-sm-6 col-xs-12" href="{{ url('projects/justificatif') }}/{{ $project->short_code }}">
							        <div class="info-box">
							            <span class="info-box-icon bg-red"></span>

							            <div class="info-box-content">
							              <span class="info-box-text">Justificatif</span>
							            	@if($project->justificatif)
							            		<i class="fa fa-check fa-lg" style="color:green"></i>	
							            	@endif
							            </div>
							        </div>
							    </a>
							    <a class="col-md-3 col-sm-6 col-xs-12" href="{{ url('projects/objectifs') }}/{{ $project->short_code }}">
							        <div class="info-box">
							            <span class="info-box-icon bg-red"></span>
							            <div class="info-box-content">
							            	<span class="info-box-text">Objectifs</span>
							            	@if($project->objectif)
							            		<i class="fa fa-check fa-lg" style="color:green"></i>	
							            	@endif
							            </div>
							        </div>
							    </a>
							    <a class="col-md-3 col-sm-6 col-xs-12" href="{{ url('projects/cible') }}/{{ $project->short_code }}">
							        <div class="info-box">
							            <span class="info-box-icon bg-red"></span>

							            <div class="info-box-content">
							              <span class="info-box-text">Cible</span>
							               @if($project->cible)
							            		<i class="fa fa-check fa-lg" style="color:green"></i>	
							            	@endif
							            </div>
							        </div>
							    </a>
							    <a class="col-md-3 col-sm-6 col-xs-12" href="{{ url('projects/resultats') }}/{{ $project->short_code }}">
							        <div class="info-box">
							            <span class="info-box-icon bg-red"></span>

							            <div class="info-box-content">
							              <span class="info-box-text">Resultats</span>
							            	@if($project->resultats)
							            		<i class="fa fa-check fa-lg" style="color:green"></i>	
							            	@endif
							            </div>
							        </div>
							    </a>
							    <a class="col-md-3 col-sm-6 col-xs-12" href="{{ url('projects/composante') }}/{{ $project->short_code }}">
							        <div class="info-box">
							            <span class="info-box-icon bg-red"></span>

							            <div class="info-box-content">
							            	<span class="info-box-text">Composante</span>
								            	@if($project->composante)
								            		<i class="fa fa-check fa-lg" style="color:green"></i>	
								            	@endif
								            </div>
							        </div>
							    </a>
							    <a class="col-md-3 col-sm-6 col-xs-12" href="{{ url('projects/methodologie') }}/{{ $project->short_code }}">
							        <div class="info-box">
							            <span class="info-box-icon bg-red"></span>

							            <div class="info-box-content">
							              <span class="info-box-text">Methodologie</span>
							               @if($project->methodologie)
							            		<i class="fa fa-check fa-lg" style="color:green"></i>	
							            	@endif
							            </div>
							        </div>
							    </a>
							    <a class="col-md-3 col-sm-6 col-xs-12" href="{{ url('projects/context') }}/{{ $project->short_code }}">
							        <div class="info-box">
							            <span class="info-box-icon bg-red"></span>

							            <div class="info-box-content">
							              <span class="info-box-text">hypothèse</span>
							              @if($project->hypothese)
							            		<i class="fa fa-check fa-lg" style="color:green"></i>	
							            	@endif
							            </div>
							        </div>
							    </a>
							    <a class="col-md-3 col-sm-6 col-xs-12" href="{{ url('projects/activites') }}/{{ $project->short_code }}">
							        <div class="info-box">
							            <span class="info-box-icon bg-red"></span>

							            <div class="info-box-content">
							              <span class="info-box-text">Activités</span>
							              @if($project->avtivites)
							            		<i class="fa fa-check fa-lg" style="color:green"></i>	
							            	@endif
							            </div>
							        </div>
							    </a>
							    <a class="col-md-3 col-sm-6 col-xs-12" href="{{ url('projects/cadre-logique') }}/{{ $project->short_code }}">
							        <div class="info-box">
							            <span class="info-box-icon bg-red"></span>

							            <div class="info-box-content">
							              <span class="info-box-text">cadre logique</span>
							              <i class="fa fa-check fa-lg" style="color:green"></i>
							            </div>
							        </div>
							    </a>
							    <a class="col-md-3 col-sm-6 col-xs-12" href="{{ url('projects/execution') }}/{{ $project->short_code }}">
							        <div class="info-box">
							            <span class="info-box-icon bg-red"></span>

							            <div class="info-box-content">
							              <span class="info-box-text">plan d'exécution du projet</span>
							               @if($project->executions)
							            		<i class="fa fa-check fa-lg" style="color:green"></i>	
							            	@endif
							            </div>
							        </div>
							    </a>
							    <a class="col-md-3 col-sm-6 col-xs-12" href="{{ url('projects/budget') }}/{{ $project->short_code }}">
							        <div class="info-box">
							            <span class="info-box-icon bg-red"></span>

							            <div class="info-box-content">
							              <span class="info-box-text">Budget</span>
							               @if($project->budgets)
							            		<i class="fa fa-check fa-lg" style="color:green"></i>	
							            	@endif
							            </div>
							        </div>
							    </a>
							    <a class="col-md-3 col-sm-6 col-xs-12" href="{{ url('projects/synoptique') }}/{{ $project->short_code }}">
							        <div class="info-box">
							            <span class="info-box-icon bg-red"></span>
							            <div class="info-box-content">
							              <span class="info-box-text">fiche synoptique(pas fait)</span>
							              <i class="fa fa-check fa-lg" style="color:green"></i>
							            </div>
							        </div>
							    </a>
			    			</div>
						</p>
					</div>
				</div>

				<!--
				<div class="group" style="margin-left:10px;margin-top:30px">
					<div class="panel-heading header" style="font-size: 16px;">
						<span>FIN DU PROJET</span>
						<span class="collapsed-indicator pull-right fa fa-minus" style="cursor:pointer"></span>
					</div>
					<div class="panel-body" style="display: block">
						<p>
						<div class="row">
							<a class="col-md-3 col-sm-6 col-xs-12" href="{{ url('projects/echec') }}/{{ $project->short_code }}">
						        <div class="info-box">
						            <span class="info-box-icon bg-red"></span>

						            <div class="info-box-content">
						            	<span class="info-box-text">Echec</span>
							            @if($project->echec)
							            		<i class="fa fa-check fa-lg" style="color:green"></i>	
							            	@endif
						            </div>
						        </div>
						    </a>
						    <a class="col-md-3 col-sm-6 col-xs-12" href="{{ url('projects/success') }}/{{ $project->short_code }}">
						        <div class="info-box">
						            <span class="info-box-icon bg-red"></span>
						            <div class="info-box-content">
						            	<span class="info-box-text">Succes</span>
						            	@if($project->success)
							            		<i class="fa fa-check fa-lg" style="color:green"></i>	
							            	@endif
						            </div>
						        </div>
						    </a>
						    <a class="col-md-3 col-sm-6 col-xs-12" href="{{ url('projects/potentialites') }}/{{ $project->short_code }}">
						        <div class="info-box">
						            <span class="info-box-icon bg-red"></span>
						            <div class="info-box-content">
						              <span class="info-box-text">Potentialités</span>
						               @if($project->potentialites)
						              	<i class="fa fa-check fa-lg" style="color:green"></i>	
						              @endif
						            </div>
						        </div>
						    </a>
						    <a class="col-md-3 col-sm-6 col-xs-12" href="{{ url('projects/obstacles') }}/{{ $project->short_code }}">
						        <div class="info-box">
						            <span class="info-box-icon bg-red"></span>
						            <div class="info-box-content">
						              <span class="info-box-text">Obstacles</span>
						               @if($project->obstacles)
						              	<i class="fa fa-check fa-lg" style="color:green"></i>	
						              @endif
						            </div>
						        </div>
						    </a>
						    <a class="col-md-3 col-sm-6 col-xs-12" href="{{ url('projects') }}/{{strtolower($project->short_code)}}/participants">
						        <div class="info-box">
						            <span class="info-box-icon bg-red"></span>
						            <div class="info-box-content">
						              <span class="info-box-text">Participants</span>
						               @if($project->participants)
						              	<i class="fa fa-check fa-lg" style="color:green"></i>	
						              @endif
						            </div>
						        </div>
						    </a>
						    <a class="col-md-3 col-sm-6 col-xs-12" href="{{ url('/projects')}}/{{strtolower($project->short_code)}}/rapport_financier">
						        <div class="info-box">
						            <span class="info-box-icon bg-red"></span>
						            <div class="info-box-content">
						              <span class="info-box-text">Bilan Financier</span>
						               @if($project->bilan_financier)
						              	<i class="fa fa-check fa-lg" style="color:green"></i>	
						              @endif
						            </div>
						        </div>
						    </a>
						    </div>
						</p>
					</div>
				</div>-->
        	</div>
	    </div>
	</div>
	<script>
		$( function() {
			$(".collapsed-indicator").click(function(e){
				var click = $(this);
				var panel_body = click.parent().parent().find(".panel-body");

				if(click.hasClass("fa-minus")){
					panel_body.slideUp("slow", function(e){
						click.removeClass("fa-minus").addClass("fa-plus");
					});
				}else{
					panel_body.slideDown("slow", function(e){
						click.removeClass("fa-plus").addClass("fa-minus");
					});
				}
			})
	  	});
  </script>
@endsection