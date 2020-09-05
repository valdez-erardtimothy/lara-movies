<?php

namespace App\Http\Controllers;

use App\ActorRole;
use Illuminate\Http\Request;

class ActorRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $actorroles =  ActorRole::all();

        return view('pages.actorroles.list', compact('actorroles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.actorroles.create');
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
        $validated = $this->form_validation($request);
        $actorrole = new ActorRole();
        $actorrole->role= $validated['role'];
        $actorrole->save();
        
        return redirect()->action('ActorRoleController@index')->with('update', 'Role added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ActorRole  $actorrole
     * @return \Illuminate\Http\Response
     */
    public function show(ActorRole $actorrole)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ActorRole  $actorrole
     * @return \Illuminate\Http\Response
     */
    public function edit(ActorRole $actorrole)
    {
        //
        return view('pages.actorroles.update', compact('actorrole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ActorRole  $actorRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActorRole $actorrole)
    {
        $validated = $this->form_validation($request);
        $actorrole->role= $validated['role'];
        $actorrole->save();
        
        return redirect()->action('ActorRoleController@index')->with('update', 'Role added!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ActorRole  $actorRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActorRole $actorrole)
    {
        //
        $actorrole->delete();

        return redirect()->action('ActorRoleController@index')->with('update', 'Role deleted!');
    }

    private function form_validation(Request $request) {
        return $request->validate([
            'role' => 'required'
        ]);
    }
}
