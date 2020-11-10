{{-- 
    required blade sections:
    'form_open' => laravel collective syntax for opening a form (create or edit)
    
    required variables:
    $genres => array of genres , with model id as index and the genre string as field
    $form_open => the form open HTML generated by LaravelCollective\HTML
    $submit_text => the text for submit button
--}}
{{ $form_open }} 
<div class="form-group">
    {{ Form::label('film_title', "Film Title"), ['class'=>'form label']}}
    {{ Form::text('film_title', null, ['class' => 'form-control', 'required'=>'required']) }}
    @error('film_title')
        <p class="alert alert-danger">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    {{ Form::label('genre_id', "Genre", ['class'=>'form label'])}}
    {{ Form::select('genre_id', $genres, null, ['class' => 'form-control', 'required'=>'required']) }}
    @error('genre_id')
        <p class="alert alert-danger">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    {{ Form::label('poster', "Poster", ['class'=>'form label'])}}
    {!! Form::file("poster", ["class"=>'form-control-file']) !!}
    @error('poster')
        <p class="alert alert-danger">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    {{ Form::label('story', "Story", ['class'=>'form label'])}}
    {{ Form::textarea('story', null, ['class' => 'form-control', 'required'=>'required']) }}
    @error('story')
        <p class="alert alert-danger">{{ $message }}</p>
    @enderror
</div>


<div class="form-group">
    {{ Form::label('release_date', "Release Date", ['class'=>'form label'])}}
    {{ Form::date('release_date', null, ['class' => 'form-control', 'required'=>'required']) }}
    @error('release_date')
        <p class="alert alert-danger">{{ $message }}</p>
    @enderror
</div>


<div class="form-group">
    {{ Form::label('duration', "Duration (minutes)", ['class'=>'form label'])}}
    {{ Form::number('duration', null, ['class' => 'form-control', 'required'=>'required']) }}
    @error('duration')
        <p class="alert alert-danger">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    {{ Form::label('additional_info', "Additional Info", ['class'=>'form label'])}}
    {{ Form::text('additional_info', null, ['class' => 'form-control']) }}
    @error('duration')
        <p class="alert alert-danger">{{ $message }}</p>
    @enderror
</div>

{{ Form::submit($submit_text, ['class'=>'btn btn-primary']) }}

{!! Form::close() !!}