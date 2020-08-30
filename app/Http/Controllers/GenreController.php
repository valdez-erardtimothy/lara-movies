<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['genres'] = Genre::with('film')->get();

        return view('pages.genres.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminatte\Http\Request $request for session flashdata (form validation)
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.genres.create');
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
        $validation = $request->validate([
            'genre' => 'required|alpha_dash_spaces|max:64'
        ]);
        $genre = new Genre();
        $genre->genre = $validation['genre'];
        $genre->save();
        return redirect()->action('GenreController@index')->with('update', "Genre added with ID {$genre->id}!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        //
        return redirect()->action('GenreController@index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        //
        return view('pages.genres.update', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
        //
        $old = $genre->genre;
        $validation = $request->validate([
            'genre' => 'required|alpha_dash_spaces|max:64'
        ]);
        $genre->genre = $validation['genre'];
        $genre->save();
        return redirect()->action('GenreController@index')->with('update', "Genre Updated from {$old} -> {$validation['genre']}!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        //
        $genre->delete();
        $old = [$genre->id, $genre->genre];
        return redirect()->action('GenreController@index')->with('update', "Genre {$genre->id} -> {$genre->genre} has been deleted!");
    }
}
