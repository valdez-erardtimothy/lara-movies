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
                    <td>{{ $producer->email }} <a class="fas fa-envelope" title="write e-mail"></a></td>
                </tr>
                <tr>
                    <th>Website: </th>
                    <td>{{ $producer->website }} <a class="fas fa-globe" title="go to site"></a></td>
                </tr>
            </table>
        </div>
        <div class="col-sm-3">
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
        </div>
    </div>
    <h4>Films Produced <a href="{{-- add film-producer --}}" class="fas fa-plus"></a></h4>
    <table class="table table-striped">
        @foreach ($producer->film()->get() as $film)
            <tr>
                <td><a href="{{ action('FilmController@show', $film) }}">{{ $film->film_title }}</a></td>
                <td><a href="{{-- remove film-producer entry --}}" class="fas fa-trash"></a></td>
            </tr>
        @endforeach
    </table>

@endsection