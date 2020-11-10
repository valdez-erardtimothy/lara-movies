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

    <h4>Films Produced <button class="btn btn-primary fas fa-plus" title="Add Film" id="add-film"></button> </small></h4>
    {{-- attach producer form validation errors--}}
    @error('producer_id', 'attach_producer')
        <p class="alert alert-primary">{{ $message }}</p>
    @enderror
    @error('film_id', 'attach_producer')
        <p class="alert alert-primary">{{ $message }}</p>
    @enderror
    <table class="table table-striped table-small">
        @foreach ($producer->film()->get() as $film)
            <tr>
                <td><a href="{{ action('FilmController@show', $film) }}">{{ $film->film_title }}</a></td>
                <td><a href="{{ action('FilmController@detachProducer', [$film, $producer] ) }}" class="fas fa-trash"></a></td>
            </tr>
        @endforeach
    </table>

    <!-- Modal for producer add form -->
    <div class="modal fade" id="addFilmModal" tabindex="-1" role="form" aria-labelledby="producerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            {!! Form::open(['route'=>'films.producers.attach', 'method'=>'POST']) !!}
            {!! Form::hidden('producer_id', $producer->id, []) !!}
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="producerModalLabel">Add produced films</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::label("film_id", "Film", ['class'=>'form-label', "required"]) !!}
                        {!! Form::select("film_id", $films, null, ['class' => 'form-control']) !!}
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {!! Form::submit("Add", ['class'=> 'btn btn-primary']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>


@endsection
@section('additional_js')
    <script src="{{ asset('/js/producer_edit.js')}}"></script>    
@endsection
