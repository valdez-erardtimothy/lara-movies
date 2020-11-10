@extends('layouts.default')

@section('page_title', "Deleted Films")

{{-- 
    required variables:
    $films : the deleted film list    
--}}
@section('main_content')
    <h1>
        Deleted Films 
    </h1>
    @if (session('update'))
    <p class="alert alert-primary">{{ session('update') }}</p>
    @endif

    <div class='row'>
        <table class="table">
            <thead>
                <tr>
                    <th>Film Title</th>
                    <th>Date and Time Deleted</th>
                    <th>Restore</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($films as $film)
                <tr>
                    <td>{{ $film->film_title }}</td>
                    <td>{{ $film->deleted_at }}</td>
                    <td><a href="{{ action('FilmController@restore', $film->id) }}" class="fas fa-undo" title="restore"></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection