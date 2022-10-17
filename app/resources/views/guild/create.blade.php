@extends('layouts.app')

@section('title', "Create a new server")

@section('side-content')
    <h1>Create a server</h1>
@endsection

@section('content')
    <form action="/guild/create" method="post">
        @csrf
        <input type="text" name="displayname" id="displayname" placeholder="Display Name">
        <input type="text" name="avatar_url" id="avatar_url" placeholder="avatar_url"
               value="https://lyttle.it/favicon.ico">
        <input type="text" name="banner_url" id="banner_url" placeholder="banner_url"
               value="https://lyttle.it/favicon.ico">
        <button type="submit">Create</button>
    </form>
@endsection
