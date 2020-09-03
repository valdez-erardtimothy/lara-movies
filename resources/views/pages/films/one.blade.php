{{-- 
    required variables:
    $film :: the film model
    $roles :: actor roles table
--}}

@extends('layouts.default')

@section('page_title', $film->film_title )
@section('main_content')

    @if (session('update'))
        <p class="alert alert-primary">{{ session('update') }}</p>
    @endif

    <div class="row ">
        <div class="col-lg-5">
            <figure>
                <img src="" alt="{{ $film->film_title }} Poster">
            </figure>
        </div>
        <div class="col-lg-7">
            <h3>{{ $film->film_title }}
                <small>
                    <a href='{{ action('FilmController@edit', $film) }}' class="fas fa-edit" title="edit"></a> 
                    <a href='{{ route('films.delete', $film) }}' class="fas fa-trash" title="delete"></a>
                </small>
            </h3>
            @if (isset($film->genre) && $film->genre)
                <p>{{ $film->genre->genre }}</p>
            @else
                <p>None</p>
            @endif
            <p>{{ $film->duration }} minutes</p>
            <p>Released {{ $film->release_date }}</p>
        </div>
    </div>
    <h4>Story</h4>
    <p>{{ $film->story }}</p>
    
    <h4>Additional Info</h4>
    <p>{{ $film->additional_info }}</p>

    <div class="row">
        <div class="col-md-9">
            <h4>Actors</h4>
            <table class="table table-small table-striped">
                <thead>
                    <tr>
                        <th>Actor</th>
                        <th>Character name</th>
                        <th>Role </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($film->actor()->get() as $actor)
                        <tr>
                            <td><a href="/actors/{{ $actor->id }}">{{ $actor->actor_fullname }}</a></td>
                            <td>{{ $actor->pivot->character }}</td>
                            @if (isset($actor->pivot->role_id)&& $actor->pivot->role_id)
                            <td>{{ $roles[$actor->pivot->role_id] }}</td>
                            @else
                            <td>Null</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <h4>Producers</h4>
            <table class="table table-small">
                @foreach ($film->producer()->get() as $producer)
                    <tr>
                        <td><a href="/producers/{{ $producer->id }}">{{ $producer->producer_fullname }}</a></td>
                        <td><a href=""><i class="fas fa-trash" title="delete"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection