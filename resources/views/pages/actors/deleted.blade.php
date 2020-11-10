@extends('layouts.default')

@section('page_title', "Deleted Actors")

{{-- 
    required variables:
    $actors : the deleted Actors list    
--}}
@section('main_content')
    <h1>
        Deleted Actors 
    </h1>
    @if (session('update'))
    <p class="alert alert-primary">{{ session('update') }}</p>
    @endif

    <div class='row'>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date and Time Deleted</th>
                    <th>Restore</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($actors as $actor)
                <tr>
                    <td>{{ $actor->actor_fullname }}</td>
                    <td>{{ $actor->deleted_at }}</td>
                    <td><a href="{{ action('ActorController@restore', $actor->id) }}" class="fas fa-undo" title="restore"></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection