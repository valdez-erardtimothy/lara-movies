<?php

namespace App\Http\Controllers;

use App\Film;
use App\Genre;
use Illuminate\Support\Collection;
use Illuminate\Http\Request; 


class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['films'] = Film::with('genre')->get();

        return view('pages.films.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // assoc array of all genres with entity IDs as keys
        $genres= Genre::all()->mapWithKeys(function($genre) {
            return [$genre['id']=>$genre['genre']];
        });
        return view('pages.films.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validated_data = $this->form_validation($request);
        // dd($validated_data);
        $film = new Film($validated_data);
        $film->save();
        return redirect()->action('FilmController@show', [$film])->with('alert', 'Film successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function show(Film $film)
    {
        //
        $data['film'] = $film;
        $data['roles'] = \App\ActorRole::all()->toArray();

        return view('pages.films.one', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function edit(Film $film)
    {
        //
        // assoc array of all genres with entity IDs as keys
        $genres= Genre::all()->mapWithKeys(function($genre) {
            return [$genre['id']=>$genre['genre']];
        });
        return view('pages.films.update', compact('film', 'genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Film $film)
    {
        //
        $validated_data = $this->form_validation($request);

        $film->film_title = $validated_data['film_title'];
        $film->story = $validated_data['story'];
        $film->duration = $validated_data['duration'];
        $film->release_date = $validated_data['release_date'];
        $film->additional_info = $validated_data['additional_info'];
        $film->genre_id = $validated_data['genre_id'];
        $film->save();

        return redirect()->action('FilmController@show', [$film])->with('alert', 'Film edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Film  $film
     * @return \Illuminate\Http\Response
     */
    public function destroy(Film $film)
    {
        //
        $film->delete();
        return redirect()->action('FilmController@index')->with('alert', "$film->film_title has been deleted.");
    }

    /**
     * Validates the form (excluding relationships) of the film entry.
     * usable for both create and edit forms
     *
     * @param \Illuminate\Http\Request $request the request passed from another controller method
     * 
     * @return array the validated data
     *  
     * Form Validation automatically fires on failure
     */
    private function form_validation(Request $request) {
        return $request->validate([
            'film_title' => 'required|max:100',
            'genre_id' => 'required|exists:\App\Genre,id',
            'story' => 'required',
            'release_date' => 'required|date',
            'duration' => 'required|integer',
            'additional_info' => 'nullable'
        ]);
    }
}
