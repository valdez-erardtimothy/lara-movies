@extends('layouts.default')

@section('name', "{{ $producer->producer_fullname }}")

@section('main_content')
    @if (session('update'))
        <p class="alert alert-primary"> {{ session('update') }}</p>
    @endif
    <div class="row">
        <div class="col-sm-6">
            <h2>{{ $producer->producer_fullname }}</h2>
            <table>
                <tr>
                    <th>E-mail: </th>
                    <td>{{ $producer->email }} <a class="fas fa-envelope" title="write e-mail" href="mailto:{{ $producer->email }}"></a></td>
                </tr>
                <tr>
                    <th>Website: </th>
                    <td>{{ $producer->website }} <a class="fas fa-globe" title="go to site" href="{{ $producer->website }}"></a></td>
                </tr>
            </table>
        </div>
        <div class="col-sm-3">
            @admin
            <ul class="list-group">
                <li class="list-group-item">Actions</li>
                <li class="list-group-item list-group-item-action"><a href="{{ action('ProducerController@edit', $producer) }}">Edit <i class="fas fa-edit"></i></a></li>
                <li class="list-group-item list-group-item-action">
                    <a 
                    href="{{ route('producers.delete', $producer) }}" 
                    onclick="return confirm('delete {{ $producer->producer_fullname }}? THIS PROCESS IS IRREVERSIBLE.') ">Delete <i class="fas fa-trash"></i>
                    </a>
                </li>
            </ul>
            @endadmin
        </div>
    </div>
    <hr>
    <h4>Films Produced </h4>
    <table class="table table-striped table-small">
        @foreach ($producer->film()->get() as $film)
            <tr>
                <td><a href="{{ action('FilmController@show', $film) }}">{{ $film->film_title }}</a></td>
            </tr>
        @endforeach
    </table>

@endsection