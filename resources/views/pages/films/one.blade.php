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
        <div class="col-lg-8">
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
            <h4>Story</h4>
            <p>{{ $film->story }}</p>
            
            <h4>Additional Info</h4>
            <p>{{ $film->additional_info }}</p>
        
        </div>
        <div class="col-lg-4">
            <figure>
                <img src="{{ $film->getFirstMediaUrl() }}" width="100%">
            </figure>
        </div>
    </div>
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
                    @foreach ($film->actor as $actor)
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
    
    <h4>Ratings</h4>
    <div class="border border-primary p-3">
        @guest
            <p>Please <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> in to rate this film!</p>
        @else
            @php
                $cur_user = $film->user()->find(Auth::user());
                $pivot = $cur_user?$cur_user->pivot:null;
                $rating=$pivot?$pivot->rating:null;
                $comment=$pivot?$pivot->comment:null;            
            @endphp
            @if ($pivot)
                <h5>You have already rated this film. <a href="{{ route('films.unrate', $film) }}" class="fas fa-trash" title="Delete your rating">Submit a new one</a></h5>
                <p>Rated {{ $rating }} out of 5</p>
                <p>Your comment:</p>
                <blockquote class="blockquote">
                    <p class="mb-0">{{ $comment }}</p>
                </blockquote>
                
            @else
                <h5>Submit your rating now!</h5>
                {!! Form::open(['route'=>['films.rate', $film], 'method'=>'POST']) !!}
                <div class="form-group">
                    {!! Form::label("rating", "Rating", ["class"=>"form-label"]) !!}
                    {!! Form::select("rating", ['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5',], ['class'=>'form-control', 'required']) !!}
                    @error('rating')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label("comment", "Comment", $rating, ['class'=>'form-label']) !!}
                    {!! Form::textarea("comment", $comment, ['class'=>"form-control"]) !!}
                    @error('comment')
                        <p class="alert alert-danger"> {{ $message }}</p>
                    @enderror
                </div>
                {!! Form::submit("Rate/Update Rating", ["class"=>"btn btn-primary"]) !!}
                {!! Form::close() !!}
            @endif
            
        @endguest
    </div>
    <hr/>
    @foreach ($film->user as $user)
    @php 
        if (Auth::check() && $user->id == Auth::user()->id) {
            continue;
        }
    @endphp
        <div class="border border-secondary p-3">
            <p>{{ $user->name }} <small>Rating: {{ $user->pivot->rating }} out of 5</small></p>
            <div class="blockquote">
                <p>{{ $user->pivot->comment }}</p>
            </div>
        </div>
    @endforeach
    <hr>
@endsection