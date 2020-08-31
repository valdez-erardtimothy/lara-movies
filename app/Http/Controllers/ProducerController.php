<?php

namespace App\Http\Controllers;

use App\Producer;
use Illuminate\Http\Request;
use ProducerSeeder;

class ProducerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['producers'] = Producer::all();
        
        return view('pages.producers.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.producers.create');
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
        $producer = new Producer();
        $producer->producer_fullname = $request->producer_fullname;
        $producer->email = $request->email;
        $producer->website = $request->website;
        $producer->save();

        return redirect()->action('ProducerController@show', $producer)->with('update', 'producer added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producer  $producer
     * @return \Illuminate\Http\Response
     */
    public function show(Producer $producer)
    {
        //
        $data['producer'] = $producer->load('film');

        return view('pages.producers.one', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producer  $producer
     * @return \Illuminate\Http\Response
     */
    public function edit(Producer $producer)
    {
        //
        return view('pages.producers.update', compact('producer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producer  $producer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producer $producer)
    {
        //
        $producer->producer_fullname = $request->producer_fullname;
        $producer->email = $request->email;
        $producer->website = $request->website;
        $producer->save();

        return redirect()->action('ProducerController@show', $producer)->with('update', 'producer updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producer  $producer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producer $producer)
    {
        //
        $producer->film()->detach(); // remove fks
        $producer->delete();
        return redirect()->action('ProducerController@index')->with('update', "{$producer->producer_fullname} has been permanently deleted.");
    }
}
