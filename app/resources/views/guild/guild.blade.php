@extends('layouts.app')

@section('title', $guild->displayname)


@section('side-content')
    <section class="space-out">
        <article>
            <h1>{{ $guild->displayname }}</h1>
            @include('channel.channels')
        </article>
        <div>
            @if ($isOwner)
                <a href="/guild/{{$guild->id}}/create">Add Channel</a>
                <a href="/guild/{{$guild->id}}/edit">Edit Server</a>
            @endif
        </div>
    </section>
@endsection

@section('content')
    <section class="space-out">
        @include('message.messages')
        @include('message.createMessage')
    </section>
@endsection
