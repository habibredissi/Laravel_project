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

Route::name('language')->get('language/{lang}', 'HomeController@language');

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::resource('/user', 'BetController');
Route::get('/user/bet/{id}', 'BetController@createBetForMatch');
Route::get('/admin/bets', 'BetController@index')->middleware('isAdmin');
Route::get('/user/allBets/{id}', 'BetController@seeBetsOfUser');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('', 'MatchsController@index');
// Route::get('/admin/Crea', 'Admin@createTeam');

Route::resource('/teams', 'TeamsController');
Route::resource('/admin/players', 'AdminPlayersController')->middleware('isAdmin');
Route::get('/admin/players/playersByTeam/{id}', 'AdminPlayersController@playersByTeam')->middleware('isAdmin');
Route::get('/stats/teams', 'StatsController@index');
Route::get('/stats/statByMatch/{id}', 'StatsController@statByMatch');
Route::get('stats/playersByTeam/{id}', 'StatsController@playersByTeam');

Route::get('/admin/stats/addStats/{id}', 'AdminStatsController@createStatsForMatch')->middleware('isAdmin');

Route::get('/admin/stats/statByMatch/{id}', 'AdminStatsController@statByMatch')->middleware('isAdmin');
// to go to adminroles controller
Route::resource('/admin/stats', 'AdminStatsController')->middleware('isAdmin');


Route::resource('/admin/teams', 'AdminTeamsController')->middleware('isAdmin');
Route::resource('/admin/roles', 'AdminRolesController')->middleware('isAdmin');
Route::resource('/admin/placements', 'AdminPlacementsController')->middleware('isAdmin');
Route::resource('/admin/matchs', 'AdminMatchsController')->middleware('isAdmin');
Route::resource('/admin', 'AdminController')->middleware('isAdmin');



// Route::get('/admin/teams/', 'AdminTeamsController@index');