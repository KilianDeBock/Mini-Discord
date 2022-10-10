@php include 'data_tmp.php'; @endphp

@extends('layouts.base')

<head>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

@section('body')
    @section('header')
        <header class="side-menu">
            <ul class="guilds">
                @foreach($guilds as $guild)
                    @include('layouts.guild_list')
                @endforeach
                <li class="app-version"><span class="app-version__text">Version 1.0</span></li>
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
