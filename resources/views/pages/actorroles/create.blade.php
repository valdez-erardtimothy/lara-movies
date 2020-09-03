@extends('layouts.default')

@section('page_title', "Add Actor Roles")


@section('main_content')
    @php
        $form_open = Form::open(['action'=>'ActorRoleController@store']);
        $form_submit = "Add Actor";
    @endphp

    @include('components.actorroles.mainform')
@endsection