<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['authOng']], function(){
	//Route::resource('projects', 'ProjectController');
	Route::get('projects', 'ProjectController@index')->name('projects.index');
	Route::post('projects', 'ProjectController@store')->name('projects.store');
	Route::get('projects/create', 'ProjectController@create')->name('projects.create');
	Route::get('projects/show/{short_code}', 'ProjectController@show')->name('projects.show');
	Route::get('projects/context/{short_code}', 'ContextController@show')->name('projects.context');
	Route::post('projects/context/{short_code}', 'ContextController@store')->name('projects.context');
	Route::get('projects/justificatif/{short_code}', 'JustificatifController@show')->name('projects.justificatif');
	Route::post('projects/justificatif/{short_code}', 'JustificatifController@store')->name('projects.justificatif');
	Route::get('projects/objectifs/{short_code}', 'ObjectifController@show')->name('projects.objectif');
	Route::post('projects/objectifs/{short_code}', 'ObjectifController@store')->name('projects.objectif');
	Route::get('projects/cible/{short_code}', 'CibleController@show')->name('projects.cible');
	Route::post('projects/cible/{short_code}', 'CibleController@store')->name('projects.cible');
	Route::get('projects/resultats/{short_code}', 'ResultatsController@show')->name('projects.resultats');
	Route::post('projects/resultats/{short_code}', 'ResultatsController@store')->name('projects.resultats');
	Route::get('projects/composante/{short_code}', 'ComposanteController@show')->name('projects.composante');
	Route::post('projects/composante/{short_code}', 'ComposanteController@store')->name('projects.composante');
	Route::get('projects/methodologie/{short_code}', 'MethodologieController@show')->name('projects.methodologie');
	Route::post('projects/methodologie/{short_code}', 'MethodologieController@store')->name('projects.methodologie');
	Route::get('projects/activites/{short_code}', 'ActivitesController@index');
	Route::get('projects/activites/{short_code}/create', 'ActivitesController@create');
	Route::post('projects/activites/{short_code}/store', 'ActivitesController@store');
	Route::get('projects/{project_short_code}/activites/show/{activite_short_code}', 'ActivitesController@show');
	Route::get('projects/{project_short_code}/activites/edit/{activite_short_code}', 'ActivitesController@edit');
	Route::put('projects/{project_short_code}/activites/update/{activite_short_code}', 'ActivitesController@update');
	Route::get('projects/{project_short_code}/activites/delete/{activite_short_code}', 'ActivitesController@destroy');
	Route::get('projects/cadre-logique/{short_code}', 'CadreLogiqueController@show')->name('projects.cadre');
	Route::post('projects/cadre-logique/{short_code}', 'CadreLogiqueController@store')->name('projects.cadre');
	Route::get('projects/hypothese/{short_code}', 'HypotheseController@show')->name('projects.hypothese');
	Route::post('projects/hypothese/{short_code}', 'HypotheseController@store')->name('projects.hypothese');
	Route::get('projects/execution/{short_code}', 'ExecutionController@show')->name('projects.execution');
	Route::post('projects/execution/{short_code}', 'ExecutionController@store')->name('projects.execution');
	Route::post('projects/save-modification/{short_code}', 'ProjectController@saveHistorisation');
	Route::get('projects/is-modification/{short_code}', 'ProjectController@isModification');
});

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'Admin\AdminController@index')->name('admin');

Route::get('/admin/users/changed-statut', 'Admin\UserController@changedStatut');

Route::resource('/admin/users', 'Admin\UserController');

Route::prefix('bayeurs')->group(function () {
	Route::group(['middleware' => ['authBayeur']], function(){
		Route::get('/', 'BayeurController@index');
		Route::prefix('ong')->group(function() {
			Route::get('/', 'OngController@index');
			Route::get('/create', 'OngController@create');
			Route::post('/strore', 'OngController@store')->name('postCreateOng');
			Route::get('/changed-statut', 'OngController@changedStatut')->name('changedStatutOng');

			Route::get('/projects/{ong_id}', 'OngController@getListProjects');

			//Route::get('amendement/add', '');

			//Route::get('projects', 'ProjectController@index')->name('projects.index');
			Route::get('projects', 'ProjectController@index');
			Route::get('/projects-details/{short_code}', 'BayeurController@getDetail');
				Route::get('project-follow/{short_code}', 'Bayeur\ProjectController@show');		
				Route::get('project-context/{short_code}', 'Bayeur\ContextController@show');
				//Route::post('project-context/{short_code}', 'Bayeur\ContextController@store');
				Route::get('project-justificatif/{short_code}', 'Bayeur\JustificatifController@show');
				//Route::post('project-justificatif/{short_code}', 'Bayeur\JustificatifController@store');
				Route::get('project-objectifs/{short_code}', 'Bayeur\ObjectifController@show');
				//Route::post('project-objectifs/{short_code}', 'Bayeur\ObjectifController@store');
				Route::get('project-cible/{short_code}', 'Bayeur\CibleController@show');
				//Route::post('project-cible/{short_code}', 'Bayeur\CibleController@store');
				Route::get('project-resultats/{short_code}', 'Bayeur\ResultatsController@show');
				//Route::post('project-resultats/{short_code}', 'Bayeur\ResultatsController@store');
				Route::get('project-composante/{short_code}', 'Bayeur\ComposanteController@show');
				//Route::post('project-composante/{short_code}', 'Bayeur\ComposanteController@store');
				Route::get('project-methodologie/{short_code}', 'Bayeur\MethodologieController@show');
				//Route::post('project-methodologie/{short_code}', 'Bayeur\MethodologieController@store');
				Route::get('project-activites/{short_code}', 'Bayeur\ActivitesController@index');
				//Route::get('project-activites/{short_code}/create', 'Bayeur\ActivitesController@create');
				//Route::post('project-activites/{short_code}/store', 'Bayeur\ActivitesController@store');
				Route::get('project-activites/show/{activite_short_code}', 'Bayeur\ActivitesController@show');
				//Route::get('project-activites/{project_short_code}/activites/edit/{activite_short_code}', 'ActivitesController@edit');
				//Route::put('project-activites/{project_short_code}/activites/update/{activite_short_code}', 'ActivitesController@update');
				//Route::get('project-activites/{project_short_code}/activites/delete/{activite_short_code}', 'ActivitesController@destroy');
				Route::get('project-cadre-logique/{short_code}', 'Bayeur\CadreLogiqueController@show');
				//Route::post('project-cadre-logique/{short_code}', 'CadreLogiqueController@store');
				Route::get('project-execution/{short_code}', 'Bayeur\ExecutionController@show');
				//Route::post('projects/execution/{short_code}', 'ExecutionController@store');
				Route::post('projects/save-modification/{short_code}', 'ProjectController@saveHistorisation');
				Route::get('project-hypothese/{short_code}', 'Bayeur\HypotheseController@show')->name('projects.hypothese');
				//Route::post('projechypothese/{short_code}', 'HypotheseController@store')->name('projects.hypothese');			
		});
		Route::prefix('projects')->group(function() {
			Route::get('/', 'Bayeur\ProjectController@index');
			Route::get('/create', 'Bayeur\ProjectController@create');
			Route::post('/store', 'Bayeur\ProjectController@store');
			Route::prefix('historisations')->group(function (){
				Route::prefix('{short_code}')->group(function (){
					Route::get('/', 'Bayeur\ProjectHistorisationController@index');
				});
			});
			Route::get('historisations-versions/{projectHistorisationId}', 'Bayeur\ProjectHistorisationController@showVersion');
			Route::get('historisation-context/{projectHistorisationId}', 'Bayeur\ProjectHistorisation\ContextController@show');
			Route::get('historisation-justificatif/{projectHistorisationId}', 'Bayeur\ProjectHistorisation\JustificatifController@show');
			Route::get('historisation-objectifs/{projectHistorisationId}', 'Bayeur\ProjectHistorisation\ObjectifController@show');
			Route::get('historisation-cible/{projectHistorisationId}', 'Bayeur\ProjectHistorisation\CibleController@show');
			Route::get('historisation-resultats/{projectHistorisationId}', 'Bayeur\ProjectHistorisation\ResultatController@show');
			Route::get('historisation-composante/{projectHistorisationId}', 'Bayeur\ProjectHistorisation\ComposanteController@show');
			Route::get('historisation-methodologie/{projectHistorisationId}', 'Bayeur\ProjectHistorisation\MethodologieController@show');
			Route::get('historisation-cadre-logique/{projectHistorisationId}', 'Bayeur\ProjectHistorisation\CadreLogiqueController@show');
			Route::get('historisation-execution/{projectHistorisationId}', 'Bayeur\ProjectHistorisation\ExecutionController@show');
			Route::get('historisation-hypothese/{projectHistorisationId}', 'Bayeur\ProjectHistorisation\HypotheseController@show');
		});
	});

	Route::get('/login', 'AuthBayeur\LoginBayeurController@showLoginForm')->name('getBayeurLogin');
	Route::post('/login', 'AuthBayeur\LoginBayeurController@login')->name('postBayeurLogin');
});

Route::prefix('ongs')->group(function() {
	Route::group(['middleware' => ['authOng']], function(){
		Route::get('/', 'Ong\OngController@index');
	});

	Route::get('/login', 'Ong\AuthOng\LoginOngController@showLoginForm')->name('getOngLogin');
	Route::post('/login', 'Ong\AuthOng\LoginOngController@login')->name('postOngLogin');
	Route::post('/logout', 'Ong\AuthOng\LoginOngController@logout');
});

Route::get('test', function(){
	//$historisations = App\ProjectHistorisation::all();
	$contexts = App\Context::all();
	//dd($historisations[1]->context);
	dd($contexts);
});

Route::prefix('teachers')->group(function(){
	Route::group(['middleware' => ['authTeacher']], function(){
		Route::get('/', function(){
			dd("nous sommes dans l'espace teacher");
		});
	});

	Route::get('login', function(){
		dd("nous sommes dans l'espace de connection de teacher");
	});
});