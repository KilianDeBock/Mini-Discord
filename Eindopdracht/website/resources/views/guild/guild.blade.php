@extends('layouts.app')

@section('title', $guild->displayname)

@section('popup')
    @include('guild.create')
    @include('guild.edit')
    @include('channel.create')
    @include('popup.confirm')
@endsection

@section('side-content')
    <section>
        <article class="guild-info">
            <h1 class="guild-info__title">{{ $guild->displayname }}</h1>
            @if ($isOwner)
                <button class="popup-button guild-info__edit" data-name="edit-guild">
                    Edit Server
                </button>

                <form class="guild__delete" method="post">
                    @csrf
                    <button data-id="{{$guild->id}}">Delete Guild</button>
                </form>
            @endif
        </article>
        @include('channel.channels')
    </section>
@endsection

@section('content')
    <section class="space-out">
        @include('message.messages')
        @include('message.createMessage')
    </section>
@endsection
