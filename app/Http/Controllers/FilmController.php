<?php

namespace App\Http\Controllers;

use App\Film;
use App\Genre;
use Illuminate\Support\Collection;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;


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
     * Display the list of all soft-deleted film entries
     */
    public function deleted() {
        $films = Film::onlyTrashed()->get();

        return view('pages.films.deleted', compact('films'));
    }

    /**
     * restore a soft-deleted film entry
     * @param int $id -- the ID of deleted film to restore
     */
    public function restore($id) {
        $film = Film::onlyTrashed()->find($id);
        $film->restore();
        return redirect()->action('FilmController@deleted')->with('update', "{$film->film_title} (ID: {$film->id})  has been restored.");
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
        return redirect()->action('FilmController@show', [$film])->with('update', 'Film successfully added!');
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
        $film->load('actor', 'user');
        $data['film'] = $film;
        $data['roles'] = \App\ActorRole::all()->mapWithKeys(function($role) {
            return[$role['id']=>$role['role']];
        });

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
        $roles = \App\ActorRole::all()->mapWithKeys(function($role) {
            return[$role['id']=>$role['role']];
        });
        $actors = \App\Actor::all()->mapWithKeys(function($actor) {
            return[$actor['id']=>"$actor[actor_fullname] ($actor[id])"];
        });
        // get only the producers not currently attached to the film
        $film_id = $film->id;
        $producers = \App\Producer::whereDoesntHave('film', function($q) use ($film_id) {
            $q->where('id', $film_id);
        })->get()->mapWithKeys(function($producer) {
            return [$producer['id']=>"$producer[producer_fullname] ($producer[id])"];
        });
        unset($film_id);

        return view('pages.films.update', compact('film', 'actors', 'genres', 'roles', 'producers'));
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

        return redirect()->action('FilmController@show', [$film])->with('update', 'Film edited!');
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
        return redirect()->action('FilmController@index')->with('update', "$film->film_title has been deleted.");
    }

    public function detachActor(Film $film, \App\Actor $actor) {
        $film->actor()->detach($actor);
        return redirect()->back()->with('update', 'Character deleted');
    }
    
    /** 
     * Add or update film-actor relationship
     */
    public function attachActor(Request $request) {
        $validated = $request->validate([
            'film_id' => 'required|exists:\App\Film,id',
            'actor_id' => 'required|exists:\App\Actor,id',
            'role_id' => 'required|exists:\App\ActorRole,id',
            'character' => 'required'
        ]);
        $film = Film::find($validated['film_id']);
        $film->actor()->syncWithoutDetaching([
            $validated['actor_id'] => [
            'role_id' => $validated['role_id'],
            'character' => $validated['character']
            ]
        ]);

        return redirect()->back()->with('update', 'Actor attached!');
    }

    public function detachProducer(Film $film, \App\Producer $producer ) {
        $film->producer()->detach($producer);
        
        return redirect()->back()->with('update', 'Producer detached!');
    }

    public function attachProducer(Request $request) {
        $validated = $request->validate([
            'film_id' =>'required|exists:\App\Film,id',
            'producer_id' => 'required|exists:\App\Producer,id'
        ]);

        $film = Film::find($validated['film_id']);
        $film->producer()->attach($validated['producer_id']);
        
        return redirect()->back()->with('update', 'Producer attached!');
    }

    /**
     * Rate the film. 
     * User is fetched via Auth.
     * @param Film $film the film to rate
     */
    public function rateFilm(Request $request, Film $film) {
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable'
        ]);

        $film->user()->syncWithoutDetaching([Auth::user()->id => [
            'rating' => $validated['rating'],
            'comment' => $validated['comment']
        ]]);
        $film->save();
        return redirect()->action('FilmController@show', $film)->with('update', "Film Rated.");
    }

    public function unrateFilm(Film $film) {
        $film->user()->detach(Auth::user());
        return redirect()->action('FilmController@show', $film)->with('update', "Film Rating removed.");
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
