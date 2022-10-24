@extends('layouts.app')

@section('title', $guild->displayname)

@section('popup')
    @include('guild.create')
    @include('guild.edit')
    @include('channel.create')
@endsection

@section('side-content')
    <section>
        <article class="guild-info">
            <h1 class="guild-info__title">{{ $guild->displayname }}</h1>
            @if ($isOwner)
                <button class="popup-button guild-info__edit" data-name="edit-guild">
                    Edit Server
                </button>
            @endif
        </article>
        @include('channel.channels')
        <div>
        </div>
    </section>
@endsection

@section('content')
    <section class="space-out">
        @include('message.messages')
        @include('message.createMessage')
    </section>
@endsection
