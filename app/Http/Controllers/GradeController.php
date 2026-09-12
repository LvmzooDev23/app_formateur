<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Student;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function edit(Exam $exam)
    {
        $course = $exam->course;
        $students = Student::where('class_id', $course->class_id)->get();
        
        // Pre-fill grades
        $grades = Grade::where('exam_id', $exam->id)->pluck('score', 'student_id')->toArray();

        return view('grades.edit', [
            'exam' => $exam,
            'students' => $students,
            'grades' => $grades,
        ]);
    }

    public function store(Request $request, Exam $exam)
    {
        $request->validate([
            'grades' => 'required|array',
            'grades.*' => 'required|numeric|min:0|max:20',
        ]);

        foreach ($request->grades as $studentId => $score) {
            Grade::updateOrCreate(
                ['student_id' => $studentId, 'exam_id' => $exam->id],
                ['score' => $score]
            );
        }

        return redirect()->back()->with('success', 'Notes enregistrées.');
    }
}
