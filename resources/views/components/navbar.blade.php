@php
    $navbar_items = [
        // 'Display Name' => 'route'
        'Home' => "/",
        'Films' => "/films",
        'Actors' => "/actors",
        'Producers' => '/producers'
    ];

    // TODO later: navbar items that will only show upon passing admin check
    $admin_bar_items = [
        'Genres' => action('GenreController@index'),
        'Users' => '/users' 
    ];
@endphp
<nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <a class="navbar-brand" href="#">{{ config('app.name', 'Laravel') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @foreach ($navbar_items as $item => $link)
            <li class="nav-item ">
                <a class="nav-link" href="{{ $link }}">{{ $item }}</a>
            </li>
            @endforeach


            @foreach ($admin_bar_items as $admin_bar_item => $link)
            {{-- add admin check --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ $link }}">{{ $admin_bar_item }}</a>
            </li>
            @endforeach
        </ul>
        
        @guest
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        @endguest
    </div>
</nav>
  

