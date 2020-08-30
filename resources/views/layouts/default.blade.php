{{-- 
    required blade section overrides:
    page_title :: the <title></title> tag content
    main_content :: the body.

    optional blade section overrides:
    additional_css  |
    additional_js   | self explanatory
--}}

<html>
    <head>
        <title>@yield('page_title') {{ Config::get('app.name', 'Laramov') }}</title>
        {{--Bootstrap includes--}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> --}}
        @yield('additional_css')
    </head>

    <body>
        <div class="container">
            @include('components.navbar')
            @yield('main_content')
        </div>
        
        {{-- scripts --}}
        @include('components.javascripts')
    </body>
</html>