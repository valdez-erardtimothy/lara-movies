@extends('layouts.default')

@section('page_title', "Contact Us")
    

@section('main_content')
    <h1>Send an e-mail to: {{ $user->name }}</h1>
    
    {!! Form::open(['route'=>['users.contact', $user->id], 'method'=>'POST']) !!}
        
        <div class="form-group">
            {!! Form::label("message", "Message", ['class'=>'form-label']) !!}
            {!! Form::textarea("message", null, ['class'=>'form-control', 'required']) !!}
            @error('message')
               <p class="alert alert-danger"> {{ $message }}</p> 
            @enderror
        </div>
    {!! Form::submit("Send", ["class"=>"btn btn-primary"]) !!}
    {!! Form::close() !!}
@endsection