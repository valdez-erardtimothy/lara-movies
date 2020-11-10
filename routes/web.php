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

// soft-deletions and restore
Route::get('films/deleted',  'FilmController@deleted')->name('films.deleted');
Route::get('films/{id}/restore',  'FilmController@restore')->name('films.restore');
Route::get('actors/deleted',  'ActorController@deleted')->name('actors.deleted');
Route::get('actors/{id}/restore',  'ActorController@restore')->name('actors.restore');

// rating
Route::post('films/{film}/rate', 'FilmController@rateFilm')->name('films.rate');
Route::get('films/{film}/unrate', 'FilmController@unrateFilm')->name('films.unrate');

// contacting 
Route::get('contact-admin', function() {
    return view('pages.users.contact_admin');
})->name('contact-admin');
Route::post('contact-admin', 'UserController@mailAdmin')->name('contact-admin');
Route::get('users/{user}/contact-user', function(\App\User $user) {
    
    return view('pages.users.contact_user', compact('user'));
})->name('users.contact')->middleware('admin');
Route::post('users/{user}/contact-user', 'UserController@mailUser')->name('users.contact');



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
Route::resource('users', 'UserController')->only('index');
// Route::resource('films', 'FilmController')->except('destroy');
// Route::resource('actors', 'ActorController')->except('destroy');
// Route::resource('producers', 'ProducerController')->except('destroy');
// Route::resource('genres', 'GenreController')->except('destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
