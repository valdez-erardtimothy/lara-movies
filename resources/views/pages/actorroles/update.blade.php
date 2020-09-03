@extends('layouts.default')

@section('page_title', "Edit Actor Role")


@section('main_content')
    @php
        $form_open = Form::model($actorrole, ['action'=>['ActorRoleController@update', $actorrole],'method'=>'PATCH']);
        $form_submit = "Edit Actor Role";
    @endphp

    @include('components.actorroles.mainform')
@endsection