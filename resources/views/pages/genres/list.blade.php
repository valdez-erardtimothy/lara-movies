{{-- 
    required vars:
    $genres = Genre model collection
--}}
@extends('layouts.default')

@section('page_title', 'Genres')


@section('main_content')
    <h1>Genres <a href="{{ action('GenreController@create') }}" class="fas fa-plus" title="Add new Genre"></a></h1>
    @if (session('update'))
        <p class='alert alert-primary'>{{ session('update') }}</p>
    @endif
    <table class="table table-small">
        <thead>
            <tr>
                <th>Genre</th>
                <th>Films in this genre</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($genres as $genre)
                <tr>
                    <td>{{ $genre->genre }}</td>
                    <td>{{ $genre->film->count() }}</td>
                    <td><a href="{{ action('GenreController@edit', $genre) }}" class="fas fa-edit"></a></td>
                    <td><a href="{{ route('genres.delete', $genre) }}"
                         onclick="return confirm('Are you sure to delete this genre entry? THIS PROCESS IS NOT REVERSIBLE.')" class="fas fa-trash"></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection