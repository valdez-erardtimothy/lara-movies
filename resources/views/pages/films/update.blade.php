{{--
    required variables:
        $film => the film model    
--}}

@extends('layouts.default')

@section('page_title', 'Edit Film')

@section('main_content')
    <h1>{{ $film->film_title }}</h1>
    <h3>Edit Film</h3>
    
    @php
    $form_open = Form::model($film, ['action'=>['FilmController@update', $film->id], 'method'=>'PATCH']);
    $submit_text = 'Update';
    @endphp

    @include('components.films.mainform', compact('form_open', 'submit_text'))
@endsection 