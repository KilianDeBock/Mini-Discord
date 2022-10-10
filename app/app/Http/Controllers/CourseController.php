<?php

namespace App\Http\Controllers;


use App\Models\Course;
use App\Models\Teacher;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        $teachers = Teacher::all();
        return view('course.list', [
            'courses' => $courses,
            'teachers' => $teachers
        ]);
    }

    public function detail($id)
    {
        //$courseModel = new Course();
        //$course = $courseModel->find($id);

        $course = Course::find($id);
        return view('course.detail', [
            'course_id' => $id,
            'course' => $course,
        ]);
    }
}
