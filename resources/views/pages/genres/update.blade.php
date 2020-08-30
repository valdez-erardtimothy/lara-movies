@extends('layouts.default')

@section('page_title', "Update Genre")


@section('main_content')
    <h1>Update Genre</h1>
    {!! Form::model($genre, ['route' => ['genres.update', $genre->id], 'method'=>'PATCH']) !!}
    
    <div class="form-group">
        {{ Form::label('genre', "Genre", ['class' => 'form-label']) }}
        {!! Form::text('genre', null, ['class' => 'form-control', 'required']) !!}
        @error('genre')
            <p class="alert alert-danger">{{ $message }}</p>    
        @enderror
    </div>
    {!! Form::submit("Update", ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection