@extends('layouts.default')
@section('additional_css')
<style>
    body {
        height:100vh;
        text-align: center;
    }

    h1 {
        font-size:7rem;
    }

</style>
    
@endsection
@section('main_content')
    <div class="h-100 row align-items-center justify-content-center">
        <div class="">
            <h1>Welcome</h1>
            <h3>Please click an item on the navbar to start browsing our content!</h3>

        </div>
    </div>
@endsection