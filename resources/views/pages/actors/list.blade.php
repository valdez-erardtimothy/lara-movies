@extends('layouts.default')

@section('page_title', "Actors")

{{-- 
    required variables:
    $actors : the actor list    
--}}
@section('main_content')
    <h1>Actors
        <a href="{{ action('ActorController@create') }}"><small class="fas fa-plus"></small></a>
        <a href="{{ action('ActorController@deleted') }}"><small>Deleted</small></a>
    </h1>
    <div class='row '>
        @foreach ($actors as $actor)
        <div class="col-lg-4 col-md-6">
            <div class="card" >
                <img class="card-img-top" src="{{ $actor->getFirstMediaUrl() }}" width="100%">
                <div class="card-body">
                <h5 class="card-title">{{ $actor->actor_fullname }}</h5>
                <p class="card-text">{{ $actor->actor_notes }}</p>
                <a href="{{ action('ActorController@show', $actor->id) }}" class="btn btn-primary">More Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection