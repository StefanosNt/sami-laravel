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

//if not logged in hitting '/' will redirect to landing or else to homepage

Auth::routes();

Route::get('/', 'HomeController@index')->name('landing');  
Route::get('/tv/popular', 'SeriesController@popular')->middleware('auth'); 

Route::get('/tv/{id}','SeriesController@showSeries');
Route::get('/tv/{id}/season/{season}','SeriesController@getSeason');
Route::get('/tv/{id}/all','SeriesController@getAllSeasons');
Route::get('/tv/search/{title}','SeriesController@searchTvSeries');



//TESTING 

Route::get('/ss','SeriesController@ss'); 

//Route::get('/tv/{seriesTitle}','SeriesController@getTvSeries');
//Route::get('/tv/{id}/season/{season}','SeriesController@showSeriesSeason');
 

