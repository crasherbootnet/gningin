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
Route::get('projects/execution/{short_code}', 'ExecutionController@show')->name('projects.execution');
Route::post('projects/execution/{short_code}', 'ExecutionController@store')->name('projects.execution');