<?php

namespace App\Http\Controllers;

use App\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['actors'] = Actor::all();

        return view('pages.actors.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.actors.create');
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
        $actor = new Actor();
        $actor->actor_fullname = $request->actor_fullname;
        $actor->actor_notes = $request->actor_notes;
        $actor->save();

        return redirect()->action('ActorController@show', $actor)->with('update', 'Actor Successfully added!');
    }

     /**
     * Display the list of all soft-deleted actor entries
     */
    public function deleted() {
        $actors = Actor::onlyTrashed()->get();

        return view('pages.actors.deleted', compact('actors'));
    }

    /**
     * restore a soft-deleted film entry
     * @param int $id -- the ID of deleted film to restore
     */
    public function restore($id) {
        $actor = Actor::onlyTrashed()->find($id);
        $actor->restore();
        return redirect()->action('ActorController@deleted')->with('update', "{$actor->actor_fullname} (ID: {$actor->id})  has been restored.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function show(Actor $actor)
    {
        //
        $data['actor'] = $actor->load('film');
        $data['roles'] = \App\ActorRole::all()->mapWithKeys(function($role) {
            return[$role['id']=>$role['role']];
        });
        return view('pages.actors.one', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function edit(Actor $actor)
    {
        //
        return view('pages.actors.update', compact('actor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actor $actor)
    {
        //
        $validated_data = $this->form_validation($request);
        $actor->actor_fullname = $request->actor_fullname;
        $actor->actor_notes = $request->actor_notes;
        $actor->save();
        return redirect()->action('ActorController@show', $actor)->with('update', 'Actor Successfully updated!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actor $actor)
    {
        //
        $actor->delete();
        $actor->save();
        return redirect()->action('ActorController@index')->with('update', "{$actor->actor_fullname} entry removed!");
    }

    /**
     * 
     * @param \Illuminate\Http\Request $request The request variable passed on the calling function
     * 
     * @return array the validated data -- the automicatic redirect fires upon failure  
     */
    private function form_validation(Request $request) {
        return $request->validate([
            'actor_fullname' => 'required|alpha_dash_spaces|max:128',
            'actor_notes' => 'nullable'
        ]);
    }
}
