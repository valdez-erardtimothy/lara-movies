@extends('layouts.default')

@section('page_title', "Films")

{{-- 
    required variables:
    $films : the film list    
--}}
@section('main_content')
    <h1>
        Films 
        @admin
        <small><a href="{{ action('FilmController@create') }} " class="fas fa-plus"></a></small>
        <small><a href="{{ action('FilmController@deleted') }}">Deleted Records</a></small>
        @endadmin
    </h1>
    @if (session('update'))
    <p class="alert alert-primary">{{ session('update') }}</p>
    @endif

    <div class='row'>
        @foreach ($films as $film)
        <div class="col-lg-4 col-md-6">
            <div class="card" >
                <img class="card-img-top" src="{{ $film->getFirstMediaUrl() }}" width="100%">
                <div class="card-body">
                <h5 class="card-title">{{ $film->film_title }}</h5>
                @admin
                <a href='{{ action('FilmController@edit', $film) }}' class="fas fa-edit btn btn-secondary" title="edit"></a> 
                <a href='{{ route('films.delete', $film) }}' class="fas fa-trash btn btn-danger" title="delete"></a>
                @endadmin
                @if (isset($film->genre->genre))
                    <p class="card-text">{{ $film->genre->genre }}</p>
                @endif
                <p class="card-text">{{ $film->duration }} minutes</p>
                <a href="{{ action('FilmController@show', $film) }}" class="btn btn-primary">More Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection