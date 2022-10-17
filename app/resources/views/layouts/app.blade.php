@extends('layouts.base')

<head>
    @vite(['resources/sass/_reset.scss', 'resources/sass/app.scss', 'resources/js/app.js', 'resources/media/**.*'])
</head>

@section('body')
    @section('header')
        <header class="side-menu">
            <ul class="guilds">
                @if($guilds != null)
                    @foreach($guilds as $guild)
                        @include('layouts.guild_list')
                    @endforeach
                @endif
                <li class="app-version">
                    <a class="guilds__guild" href="/guild/create">
                        <h2 class="guilds__guild-name">Add New Server</h2>
                        <img class="guilds__guild-icon" src="/media/icons/plus.svg" alt="Add icon (plus)">
                    </a>
                    <span class="app-version__text">Version 1.0</span>
                </li>
            </ul>
        </header>
    @show

    <main>
        <aside>
            @yield('side-content')
        </aside>
        <section>
            @yield('content')
        </section>
    </main>
@endsection
