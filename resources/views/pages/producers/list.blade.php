{{-- 
    required variables:
    $producers :: the App\producer collection
--}}
@extends('layouts.default');

@section('page_title', 'Producers')


@section('main_content')
    <h1>Producers 
        @admin
        <small><a href="{{ action('ProducerController@create') }}" class="fas fa-plus" title="New Producer"></a></small>
        @endadmin
    </h1>
        @if (session('update'))
            <p class="alert alert-primary"> {{ session('update') }}</p>
        @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>E-mail</th>
                <th>Website</th>
                <th>View</th>
                @admin
                <th>Edit</th>
                <th>Delete</th>
                @endadmin
            </tr>
        </thead>
        @foreach ($producers as $producer)
            <tr>
                <td>{{ $producer->producer_fullname }}</td>
                <td><a href="mailto:{{ $producer->email }}">{{ $producer->email }}</a></td>
                <td><a href="{{ $producer->website }}"> {{ $producer->website }}</a></td>
                <td><a href="{{ action('ProducerController@show', $producer) }}" class="fas fa-eye"></a></td>
                @admin
                <td><a href="{{ action('ProducerController@edit', $producer) }}" class="fas fa-edit"></a></td>
                <td>
                    <a href="{{ route('producers.delete', $producer) }}" 
                    onclick="return confirm('delete {{ $producer->producer_fullname }}? THIS PROCESS IS IRREVERSIBLE.') " 
                    class="fas fa-trash">
                    </a>
                </td>
                @endadmin
            </tr>
        @endforeach
    </table>
@endsection