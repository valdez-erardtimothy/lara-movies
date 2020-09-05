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
        'Actor Roles' => action('ActorRoleController@index'),
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


            @admin
            @foreach ($admin_bar_items as $admin_bar_item => $link)
            {{-- add admin check --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ $link }}">{{ $admin_bar_item }}</a>
            </li>
            @endforeach
            @endadmin
            <li class="nav-item">
                <a class="nav-link" href="{{ route('contact-admin') }}" >Contact Us</a>
            </li>
        </ul>
        
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
  

