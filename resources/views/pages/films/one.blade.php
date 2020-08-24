{{-- 
    required variables:
    $film :: the film entry    
    $roles :: actor roles table
--}}

@extends('layouts.default')

@section('page_title', $film->film_title )
@section('main_content')
    <div class="row ">
        <div class="col-lg-5">
            <figure>
                <img src="" alt="{{ $film->film_title }} Poster">
            </figure>
        </div>
        <div class="col-lg-7">
            <h3>{{ $film->film_title }}
            <small><i class="fas fa-edit" title="edit"></i> <i class="fas fa-trash" title="delete"></i></small></h3>
            <p>{{ $film->genre->genre }}</p>
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
                            <td>{{ $roles[$actor->pivot->role_id-1]['role'] }}</td>
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