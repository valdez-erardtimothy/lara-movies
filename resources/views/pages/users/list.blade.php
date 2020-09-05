{{-- 
    $users = \App\Users::all    
--}}

@extends('layouts.default')

@section('page_title', 'Users')

@section('main_content')
    <h1>Users</h1>
    <table class="table">
        <tr>
            <th>Name</th>
            <th>E-mail</th>
            <th>Contact</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><a href="{{ route('users.contact', $user) }}" class="fas fa-envelope" title="mail user"></a></td>
            </tr>
        @endforeach
    </table>
@endsection