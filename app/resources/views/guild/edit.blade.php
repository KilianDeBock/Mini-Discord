@extends('layouts.app')

@section('title', "Edit {$guild->displayname}")

@section('side-content')
    <h1>Edit {{$guild->displayname}}</h1>
@endsection

@section('content')
    <form action="/guild/{{$guild->id}}/edit" method="post">
        @csrf
        <input type="text" name="displayname" id="displayname" value="{{$guild->displayname}}"
               placeholder="Display Name">
        <input type="text" name="avatar_url" id="avatar_url" value="{{$guild->avatar_url}}" placeholder="avatar_url">
        <input type="text" name="banner_url" id="banner_url" value="{{$guild->banner_url}}" placeholder="banner_url">
        <button type="submit">Create</button>
    </form>
@endsection
