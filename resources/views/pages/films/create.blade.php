@extends('layouts.default')

@section('page_title', 'Add Film')

@section('main_content')
    <h1>Add Film</h1>
    @php
    $data['form_open'] = Form::open(['action'=>'FilmController@store']);    
    $data['submit_text'] = "Add";
    @endphp
    @include('components.films.mainform', $data)
    <p><small>You can add the Actor casts and Producers on the edit page of this film entry.</small></p>
@endsection 