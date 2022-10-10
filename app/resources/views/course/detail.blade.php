@extends('layouts.app')

@section('title', 'Course.php Detail')

@section('content')
    <h1>Detailpagina van het vak met id: {{ $course_id }}</h1>
    <article>
        <h2>{{ $course->name }}</h2>
        <p>{{ $course->description }}</p>
    </article>
@endsection
