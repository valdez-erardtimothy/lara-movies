{{-- 
    required variables:
    $actor = the actor model entity
--}}

@extends('layouts.default')

@section('page_title', "Add Actor")


@section('main_content')
<h1>{{ $actor->actor_fullname }} Update</h1>
@if (session('update'))
    <p class="alert alert-primary">{{ session('update') }}</p>
@endif
@php
    $subview['form_open'] = Form::model($actor, ['action' => ['ActorController@update', $actor], 'method' => 'PATCH', 'files' => true]);
    $subview['submit_button'] = "Update";
@endphp
@include('components.actors.mainform', $subview)

<hr>

<div class="row">
    <div class="col">
        <h4>Stars in 
            <button id="add-film" class="fas fa-plus btn btn-primary"></button>
        </h4>
        {{-- attach actor errors --}}
        @error('actor_id', 'attach_actor')
            <p class="alert alert-primary">{{ $message }}</p>
        @enderror
        @error('film_id', 'attach_actor')
            <p class="alert alert-primary">{{ $message }}</p>
        @enderror
        @error('character', 'attach_actor')
            <p class="alert alert-primary">{{ $message }}</p>
        @enderror
        @error('role_id', 'attach_actor')
            <p class="alert alert-primary">{{ $message }}</p>
        @enderror
        <table class="table table-small table-striped">
            <thead>
                <tr>
                    <th>Film</th>
                    <th>Character name</th>
                    <th>Role </th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($actor->film()->get() as $film)
                    <tr data-film-id="{{ $film->id }}"  data-character-name="{{ $film->pivot->character }}">
                        <td><a href="{{ action('FilmController@show', $film) }}"> {{ $film->film_title }}</a></td>
                        <td>{{ $film->pivot->character }}</td>
                        @if (isset($film->pivot->role_id)&& $film->pivot->role_id)
                        <td>{{ $roles[$film->pivot->role_id] }}</td>
                        @else
                        <td>Null</td>
                        @endif
                        <td><button class="btn btn-primary fas fa-edit edit-film"></button></td>
                        <td><a href="{{ route('films.actors.detach', [$film, $actor]) }}" class="fas fa-trash btn btn-primary"></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal for actor add form -->
<div class="modal fade" id="addActorModal" tabindex="-1" role="form" aria-labelledby="actorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        {!! Form::open(['route'=>'films.actors.attach', 'method'=>'POST']) !!}
        {!! Form::hidden('actor_id', $actor->id, []) !!}
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="ActorModalLabel">Add/Update Actor Characters</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label("film_id", "Film", ['class'=>'form-label']) !!}
                    <p><small>Selecting a film that is currently listed will update their values instead.</small></p>
                    {!! Form::select("film_id", $films, null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("character", "Character Name", ['class'=>'form-label']) !!}
                    {!! Form::text("character", null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("role_id", "Role", ['class'=>'form-label']) !!}
                    {!! Form::select("role_id", $roles, null, ['class' => 'form-control']) !!}
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {!! Form::submit("Add/Update", ['class'=> 'btn btn-primary']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection

@section('additional_js')
    <script src="{{ asset('/js/actor_edit.js')}}"></script>    
@endsection