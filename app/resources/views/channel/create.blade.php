@extends('layouts.app')

@section('title', "Create a new server")

@section('side-content')
    <h1>Create a channel</h1>
@endsection

@section('content')
    <form action="/guild/{{ $guild_id }}/create" method="post">
        @csrf
        <input type="text" name="name" id="name" placeholder="NName">
        <input type="text" name="description" id="description" placeholder="description">
        <input type="hidden" name="guild_id" id="guild_id" value="{{ $guild_id }}">
        <button type="submit">Create</button>
    </form>
@endsection
