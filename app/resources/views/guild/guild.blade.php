@extends('layouts.app')

@section('title', $guild->displayname)


@section('side-content')
    <h1>{{ $guild->displayname }}</h1>
    @if ($isOwner)
        <a href="/guild/{{$guild->id}}/edit">Edit Server</a>
    @endif
    <ul>
        <li>Channel 1</li>
        <li>Channel 2</li>
    </ul>
@endsection

@section('content')
    {{ $guild->id }}
    {{ $guild->owner_id }}
    {{ $guild->created_at }}
    {{ $guild->updated_at }}
    <h1>Mini discord!</h1>
@endsection
