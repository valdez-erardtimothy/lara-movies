@extends('layouts.default')

@section('page_title', "Actor Roles")

{{-- 
    required variables:
    $actorroles : the actor roles list    
--}}

@section('main_content')
    <h1>Actor Roles <a href="{{ action('ActorRoleController@create') }}" class="fas fa-plus"></a></h1>
    @if (session('update'))
        <p class="alert alert-primary">{{ session('update') }}</p>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Role</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($actorroles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->role }}</td>
                    <td><a href="{{ route('actorroles.edit', $role) }}" class="fas fa-edit"></a></td>
                    <td><a href="{{ route('actorroles.delete', $role) }}" class="fas fa-trash"></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection