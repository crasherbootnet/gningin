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
                            @foreach($activites as $activite)
                                <div class="row">
                                    <a class="col-md-3 col-sm-6 col-xs-12" href="{{ url('projects/historisation-activites/activite') }}/{{ $activite->id }}">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-red"></span>
                                            <div class="info-box-content">
                                                <span>{{ $activite->libelle}}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
						</p>
					</div>
				</div>
        	</div>
	    </div>
	</div>
@endsection