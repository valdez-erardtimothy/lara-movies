{{--
    required variables:
        $film = the film model    
        $roles = actor roles table [id]=>[name]
        $actors = the array of actors [id]=>[name]
        $producers = the array of producers [id] => [name]
--}}

@extends('layouts.default')

@section('page_title', 'Edit Film')

@section('main_content')
    @if (session('update'))
        <p class="alert alert-primary">{{ session('update') }}</p>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <h1>{{ $film->film_title }}</h1>
    <h3>Edit Film</h3>
    @php
    $form_open = Form::model($film, ['action'=>['FilmController@update', $film->id], 'method'=>'PATCH']);
    $submit_text = 'Update';
    @endphp

    @include('components.films.mainform', compact('form_open', 'submit_text'))

    
    <div class="row">
        <div class="col-md-9">
            <h4>
                Actors 
                <button id="add-actor" class="fas fa-plus btn btn-primary"></button>
            </h4>
            <table class="table table-small table-striped">
                <thead>
                    <tr>
                        <th>ID-Actor</th>
                        <th>Character name</th>
                        <th>Role </th>
                        <td>Edit</td>
                        <td>Delete</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($film->actor()->get() as $actor)
                        <tr data-actor-id={{ $actor->id }} data-character-name="{{ $actor->pivot->character }}">
                            <td><a href="/actors/{{ $actor->id }}">{{ $actor->id }}-{{ $actor->actor_fullname }}</a></td>
                            <td>{{ $actor->pivot->character }}</td>
                            @if (isset($actor->pivot->role_id)&& $actor->pivot->role_id)
                            <td>{{ $roles[$actor->pivot->role_id] }}</td>
                            @else
                            <td>Null</td>
                            @endif
                            <td><button class="btn btn-primary fas fa-edit edit-actor"></button></td>
                            <td><a href="{{ route('films.actors.detach', [$film, $actor]) }}" class="fas fa-trash btn btn-primary"></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <h4>
                Producers 
                <button id="add-producer" class="fas fa-plus btn btn-primary"></button>
            </h4>
            <table class="table table-small">
                @foreach ($film->producer()->get() as $producer)
                    <tr data-producer-id="{{ $producer->id }}">
                        <td><a href="/producers/{{ $producer->id }}">{{ $producer->producer_fullname }}</a></td>
                        <td><a href="{{ route('films.producers.detach', [$film, $producer])}}"><i class="fas fa-trash" title="delete"></i></a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    
<!-- Modal for actor add form -->
<div class="modal fade" id="addActorModal" tabindex="-1" role="form" aria-labelledby="actorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        {!! Form::open(['route'=>'films.actors.attach', 'method'=>'POST']) !!}
        {!! Form::hidden('film_id', $film->id, []) !!}
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="ActorModalLabel">Add/Update Actor Characters</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label("actor_id", "Actor", ['class'=>'form-label']) !!}
                    <p><small>Selecting an actor that is currently in the list will update their values instead.</small></p>
                    {!! Form::select("actor_id", $actors, null, ['class' => 'form-control']) !!}
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
    
<!-- Modal for actor add form -->
<div class="modal fade" id="addProducerModal" tabindex="-1" role="form" aria-labelledby="producerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        {!! Form::open(['route'=>'films.producers.attach', 'method'=>'POST']) !!}
        {!! Form::hidden('film_id', $film->id, []) !!}
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="producerModalLabel">Add Producer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label("producer_id", "Producer", ['class'=>'form-label', "required"]) !!}
                    {!! Form::select("producer_id", $producers, null, ['class' => 'form-control']) !!}
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {!! Form::submit("Add", ['class'=> 'btn btn-primary']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection 
@section('additional_js')
    <script src="{{ asset('/js/film_edit.js')}}"></script>    
@endsection