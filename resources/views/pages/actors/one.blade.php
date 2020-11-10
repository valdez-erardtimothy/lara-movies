{{-- 
    required variables:
    $actor :: the actor entry    
    $roles :: actor roles table
--}}

@extends('layouts.default')

@section('page_title', $actor->actor_fullname )
@section('main_content')
    @if (session('update'))
        <p class="alert alert-primary">{{ session('update') }}</p>
    @endif
    <div class="row ">
        <div class="col-lg-8">
            <h3>{{ $actor->actor_fullname }}
                <small>
                    @admin
                    <a href="{{ action('ActorController@edit', $actor) }}" class="fas fa-edit btn btn-secondary" title="edit"></a> 
                    <a href="{{ route('actors.delete', $actor) }}"class="fas fa-trash btn btn-danger" title="delete"></a>
                    @endadmin
                </small>
            </h3>
            @if (isset($actor->actor_notes))
            <h5>Notes</h5>
            <p class="card-text">{{ $actor->actor_notes }}</p>
            @endif
        </div>
        <div class="col-lg-4">
            <figure>
                <img src="{{ $actor->getFirstMediaUrl() }}" width="100%">
            </figure>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
            <h4>Stars in</h4>
            <table class="table table-small table-striped">
                <thead>
                    <tr>
                        <th>Film</th>
                        <th>Character name</th>
                        <th>Role </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($actor->film()->get() as $film)
                        <tr>
                            <td><a href="{{ action('FilmController@show', $film) }}"> {{ $film->film_title }}</a></td>
                            <td>{{ $film->pivot->character }}</td>
                            @if (isset($film->pivot->role_id)&& $film->pivot->role_id)
                            <td>{{ $roles[$film->pivot->role_id] }}</td>
                            @else
                            <td>Null</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection