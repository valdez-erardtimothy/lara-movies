@extends('layouts.default')

@section('page_title', 'Add Genre')


@section('main_content')
    <h1>Add Genre</h1>
    {!! Form::open(['action' => 'GenreController@store']) !!}
    
    <div class="form-group">
        {{ Form::label('genre', "Genre", ['class' => 'form-label']) }}
        {!! Form::text('genre', null, ['class' => 'form-control', 'required']) !!}
        @error('genre')
            <p class="alert alert-danger">{{ $message }}</p>    
        @enderror
    </div>
    {!! Form::submit("Add", ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection