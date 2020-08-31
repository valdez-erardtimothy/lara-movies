@extends('layouts.default')

@section('page_title', 'Add Producer')


@section('main_content')
    <h1>Add Producer</h1>
    @php
        $form_open = Form::open(['action' => 'ProducerController@store']);
        $submit_button = 'Add'; 
    @endphp 

    @include('components.producers.mainform', compact('form_open', 'submit_button'))
@endsection