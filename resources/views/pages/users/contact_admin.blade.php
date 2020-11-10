@extends('layouts.default')

@section('page_title', "Contact Us")
    

@section('main_content')
    <h1>Contact Us</h1>
    
    <p>Feel free to say anything to us.</p>
    {!! Form::open(['route'=>['contact-admin'], 'method'=>'POST']) !!}
        <div class="form-group">
            {!! Form::label("name", "Name", ['class'=>'form-label']) !!}
            {!! Form::text("name", null, ['class'=>'form-control', 'required']) !!}
            @error('name')
               <p class="alert alert-danger"> {{ $message }}</p> 
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label("email", "Your e-mail", ['class'=>'form-label']) !!}
            {!! Form::email("email", null, ['class'=>'form-control', 'required']) !!}
            @error('email')
               <p class="alert alert-danger"> {{ $message }}</p> 
            @enderror
        </div>
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