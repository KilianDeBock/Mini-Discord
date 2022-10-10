@extends('layouts.app')

@section('title', 'Courses')

@section('content')
    <h1>Course.php List</h1>
    <form method="post">
        <label>
            Select Teacher:
            <select name="teacher" id="teacher">
                <option value="1">Select teacher</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->firstname }}</option>
                @endforeach
            </select>
        </label>
    </form>
    <ul>
        @foreach($courses as $course)
            <li>
                <a href="/course/<?= $course->id ?>">{{ $course->name }}</a>
            </li>
        @endforeach
    </ul>

@endsection
