{{-- $producer = the producer model instance --}}

@extends('layouts.default')

@section('page_title', 'Edit Producer')


@section('main_content')
    <h1>Edit Producer</h1>
    @if (session('update'))
        <p class="alert alert-primary"> {{ session('update') }}</p>
    @endif
    @php
        $form_open = Form::model($producer, ['action' => ['ProducerController@update', $producer], 'method'=>'PATCH']);
        $submit_button = 'Edit'; 
    @endphp 

    @include('components.producers.mainform', compact('form_open', 'submit_button'))
@endsection