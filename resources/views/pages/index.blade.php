@extends('layouts.default')
@section('additional_css')
{{-- <style>
    body {
        height:100vh;
        text-align: center;
    }

    h1 {
        font-size:7rem;
    }

</style>
     --}}
@endsection
@section('main_content')
    {{-- <div class="h-100 row align-items-center justify-content-center">
        <div class="">
            <h1>Welcome</h1>
            <h3>Please click an item on the navbar to start browsing our content!</h3>
            @guest
                <p>You are not logged in. you may only browse our content.</p>
            @else
                @admin
                    <p>You are logged in as an administrator</p>
                @else
                    <p>You are logged in as {{ Auth::user()->name }}</p>
                @endadmin
            @endguest

        </div>
    </div> --}}
    <div class=>
        <h1>Films</h1>
        <table id="films" class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Genre</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection


@section('additional_js')
    <script src="/js/index.js"></script>
@endsection