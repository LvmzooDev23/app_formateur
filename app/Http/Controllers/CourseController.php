<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return view('courses.index', ['courses' => Course::with('schoolClass')->withCount('exams')->latest()->get()]);
    }

    public function create()
    {
        return view('courses.create', ['classes' => SchoolClass::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:school_classes,id',
        ]);
        Course::create($request->all());
        return redirect()->route('courses.index')->with('success', 'Cours créé.');
    }

    public function edit(Course $course)
    {
        return view('courses.edit', [
            'course' => $course,
            'classes' => SchoolClass::all(),
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'class_id' => 'required|exists:school_classes,id',
        ]);
        $course->update($request->all());
        return redirect()->route('courses.index')->with('success', 'Cours mis à jour.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Cours supprimé.');
    }
}
