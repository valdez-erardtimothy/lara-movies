<?php

use Illuminate\Support\Facades\Route;

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
    return view('pages.index');
});

//detaching and attaching actors and producers 
Route::get('films/{film}/detach_actor/{actor}', 'FilmController@detachActor')->name('films.actors.detach');
Route::post('films/attach_actor', 'FilmController@attachActor')->name('films.actors.attach');
Route::get('films/{film}/detach_producer/{producer}', 'FilmController@detachProducer')->name('films.producers.detach');
Route::post('films/attach_producer', 'FilmController@attachProducer')->name('films.producers.attach');

// delete aliases to allow for anchor link deletion
Route::get('/actorroles/{actorrole}/delete/', 'ActorRoleController@destroy')->name('actorroles.delete');
Route::get('/genres/{genre}/delete/', 'GenreController@destroy')->name('genres.delete');
Route::get('/actors/{actor}/delete', 'ActorController@destroy')->name('actors.delete');
Route::get('/producers/{producer}/delete', 'ProducerController@destroy')->name('producers.delete');
Route::get('/films/{film}/delete/', 'FilmController@destroy')->name('films.delete');
Route::resources([
    'films' => 'FilmController',
    'actors' => 'ActorController',
    'producers' => 'ProducerController',
    'genres' => 'GenreController'
]);
Route::resource('actorroles', 'ActorRoleController')->except('show');
// Route::resource('films', 'FilmController')->except('destroy');
// Route::resource('actors', 'ActorController')->except('destroy');
// Route::resource('producers', 'ProducerController')->except('destroy');
// Route::resource('genres', 'GenreController')->except('destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
