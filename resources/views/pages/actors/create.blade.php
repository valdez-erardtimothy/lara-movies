@extends('layouts.default')

@section('page_title', "Add Actor")


@section('main_content')
<h1>Add an Actor</h1>
@php
    $subview['form_open'] = Form::open(['action' => 'ActorController@store']); 
    $subview['submit_button'] = "Add";
@endphp
@include('components.actors.mainform',$subview)
@endsection