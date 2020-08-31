{{-- 
    required variables:
    $actor = the actor model entity
--}}

@extends('layouts.default')

@section('page_title', "Add Actor")


@section('main_content')
<h1>{{ $actor->actor_fullname }} Update</h1>
@php
    $subview['form_open'] = Form::model($actor, ['action' => ['ActorController@update', $actor], 'method' => 'PATCH']);
    $subview['submit_button'] = "Update";
@endphp
@include('components.actors.mainform', $subview)
@endsection