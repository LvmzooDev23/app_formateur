<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Course;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        return view('exams.index', ['exams' => Exam::with('course')->get()]);
    }

    public function create()
    {
        return view('exams.create', ['courses' => Course::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'exam_date' => 'required|date',
            'coefficient' => 'required|numeric|min:0',
        ]);
        Exam::create($request->all());
        return redirect()->route('exams.index')->with('success', 'Examen créé.');
    }

    public function edit(Exam $exam)
    {
        return view('exams.edit', [
            'exam' => $exam,
            'courses' => Course::all(),
        ]);
    }

    public function update(Request $request, Exam $exam)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'exam_date' => 'required|date',
            'coefficient' => 'required|numeric|min:0',
        ]);
        $exam->update($request->all());
        return redirect()->route('exams.index')->with('success', 'Examen mis à jour.');
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->route('exams.index')->with('success', 'Examen supprimé.');
    }
}
