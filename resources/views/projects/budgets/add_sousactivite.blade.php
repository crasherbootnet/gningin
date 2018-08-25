
@extends('layouts.dashboard')

@section('title', 'Composante')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('plugin/jqueryStep/css/jquerysctipttop.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugin/jqueryStep/css/style.css') }}">

<script type="text/javascript" src="{{ asset('plugin/jqueryStep/js/show_ads.js') }}"></script>
<!-- jQuery easing plugin --> 
<script src="{{ asset('plugin/jqueryStep/js/jquery.easing.min.js') }}" type="text/javascript"></script> 

<style type="text/css">
	fieldset{
		width: 250% !important;
	}

	#msform{
		margin-left: 0%;
	}

	#progressbar{
		width: 267%;
		margin-top: -14%;
	}

	table, tr, td, th{
		text-align: center;
	}

	.alert-error{
		color: red;
	}

	.alert-primary{
	  position: relative;
	  padding: .75rem 1.25rem;
	  margin-bottom: 1rem;
	  border: 1px solid transparent;
	  border-radius: .25rem;
	  color: #004085;
	  background-color: #cce5ff;
	  border-color: #b8daff;
	  font-size: 14px;
	  margin-bottom: 20px;
	}
</style>
	<div class="content">
        <div class="container-fluid">
            <div class="row">
				<!-- multistep form -->
		<form id="msform" action="{{ route('postRegisterSousActivite', ['short_code' => $activite->short_code ]) }}" method="POST" enctype="multipart/form-data" class="from-group">
			<input type="text" name="_token" value="{{ csrf_token() }}" hidden>
			<!-- progressbar -->
			<ul id="progressbar">
				<li class="active">Creation d'une sous activité</li>
				<li>Description de la sous activité</li>
			</ul>
			<fieldset>
				<h2 class="fs-title">Creation d'une sous activité</h2>
				<h3 class="fs-subtitle">Donner un nom a la sous activité</h3>
				<input type="text" name="libelle" placeholder="Libelle" />
				<a href="{{ url('projects/budget/show-budget-activite/'.$activite->short_code) }}" class="btn btn-annuler">Annuler</a>
				<input type="button" name="next" class="next action-button" value="Next" />
			</fieldset>
			<fieldset class="fieldset-description-activite">
				<h2 class="fs-title">Description de la sous activité</h2>
				<h3 class="fs-subtitle">Décriver la sous activité </h3>
				<textarea cols="20" rows="18" name="content"></textarea>
				<div class="row group-date">
					<div class="col-md-4">
						<label>Date de debut de la sous activité (*)</label>
						<input type="date" name="date_debut" class="form-control" required>
					</div>
					<div class="col-md-4">
						<label>Date de fin de la sous activité (*)</label>
						<input type="date" name="date_fin" class="form-control" required>
					</div>
				</div>
                <div class="row">
                    <div class="col-md-4">
						<label>Budget (*)</label>
						<input type="text" name="budget" class="form-control" required>
					</div>
                </div>

				<input type="text" name="personnes" hidden>
				<a href="{{ url('projects/budget/show-budget-activite/'.$activite->short_code) }}" class="btn btn-annuler">Annuler</a>
				<input type="button" name="previous" class="previous action-button" value="Previous" />
				<button type="submit" class="btn btn-loader" name="add_activite">Terminer</button>
			</fieldset>
			
		</form>
			</div>
	    </div>
	</div>

	<script type="text/javascript">	
	
			$('#images').filestyle({
				badge: true,
				input : false,
				btnClass : 'btn-primary',
				htmlIcon : '<span class="oi oi-folder"></span> '
			});

			$("#rapport_moral_file").filestyle({
				badge: true,
				input : false,
				btnClass : 'btn-primary',
				htmlIcon : '<span class="oi oi-folder"></span> '
			});

			$("#rapport_financier_file").filestyle({
				badge: true,
				input : false,
				btnClass : 'btn-primary',
				htmlIcon : '<span class="oi oi-folder"></span> '
			});

			$("#liste_presence_file").filestyle({
				badge: true,
				input : false,
				btnClass : 'btn-primary',
				htmlIcon : '<span class="oi oi-folder"></span> '
			});

	</script>

	<script>
		$(function() {
			//jQuery time
			var current_fs, next_fs, previous_fs; //fieldsets
			var left, opacity, scale; //fieldset properties which we will animate
			var animating; //flag to prevent quick multi-click glitches
			var validate_fieldset_description_activite = true;

			$("input[name='date_debut'").change(function(e){
				if($(this).val() && $("input[name='date_fin'").val()){
					$(".error").hide('slow');
				}
			});

			$("input[name='date_fin'").change(function(e){
				if($(this).val() && $("input[name='date_fin'").val()){
					$(".error").hide('slow');
				}
			});

			$(".next").click(function(){
				//if(animating && validate_fieldset_description_activite) return false;
				//animating = true;
				
				current_fs = $(this).parent();
				next_fs = $(this).parent().next();
				
				//activate next step on progressbar using the index of next_fs
				$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

				if(current_fs.find("[required]").length !=0){
					validate_fieldset_description_activite = true;
					current_fs.find("[required]").each(function(){
						if($(this).val().length	== 0){
							validate_fieldset_description_activite = false;
						}
					});
				}

				if(validate_fieldset_description_activite){
					//show the next fieldset
					next_fs.show(); 
					//hide the current fieldset with style
					current_fs.animate({opacity: 0}, {
						step: function(now, mx) {
							//as the opacity of current_fs reduces to 0 - stored in "now"
							//1. scale current_fs down to 80%
							scale = 1 - (1 - now) * 0.2;
							//2. bring next_fs from the right(50%)
							left = (now * 50)+"%";
							//3. increase opacity of next_fs to 1 as it moves in
							opacity = 1 - now;
							current_fs.css({'transform': 'scale('+scale+')'});
							next_fs.css({'left': left, 'opacity': opacity});
						}, 
						duration: 800, 
						complete: function(){
							current_fs.hide();
							animating = false;
						}, 
						//this comes from the custom easing plugin
						easing: 'easeInOutBack'
					});
				}else{
					if(!$(".error").length){
						$(".group-date").after("<div class='row error'><p class='alert-error col-md-6'>Veillez bien renseignez les champs en (*)</p></div>");
						animating = false;
					}
				}	
			});

			$(".previous").click(function(){
				//if(animating) return false;
				//animating = true;
				
				current_fs = $(this).parent();
				previous_fs = $(this).parent().prev();
				
				//de-activate current step on progressbar
				$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
				
				//show the previous fieldset
				previous_fs.show(); 
				//hide the current fieldset with style
				current_fs.animate({opacity: 0}, {
					step: function(now, mx) {
						//as the opacity of current_fs reduces to 0 - stored in "now"
						//1. scale previous_fs from 80% to 100%
						scale = 0.8 + (1 - now) * 0.2;
						//2. take current_fs to the right(50%) - from 0%
						left = ((1-now) * 50)+"%";
						//3. increase opacity of previous_fs to 1 as it moves in
						opacity = 1 - now;
						current_fs.css({'left': left});
						previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
					}, 
					duration: 800, 
					complete: function(){
						current_fs.hide();
						animating = false;
					}, 
					//this comes from the custom easing plugin
					easing: 'easeInOutBack'
				});
			});

			$(".submit").click(function(){
				return false;
			})

			});
			</script>
			<script type="text/javascript">

			  var _gaq = _gaq || [];
			  _gaq.push(['_setAccount', 'UA-36251023-1']);
			  _gaq.push(['_setDomainName', 'jqueryscript.net']);
			  _gaq.push(['_trackPageview']);

			  (function() {
			    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			  })();

		</script>
@endsection