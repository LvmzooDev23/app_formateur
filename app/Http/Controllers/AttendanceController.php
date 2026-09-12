<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $classes = SchoolClass::all();
        $classId = $request->input('class_id');
        $date = $request->input('date', date('Y-m-d'));

        $students = [];
        if ($classId) {
            $students = Student::where('class_id', $classId)->get();
        }

        return view('attendances.index', [
            'classes' => $classes,
            'students' => $students,
            'selectedClass' => $classId,
            'selectedDate' => $date,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'attendances' => 'required|array',
            'attendances.*.status' => 'required|in:present,absent,late',
            'attendances.*.note' => 'nullable|string',
        ]);

        foreach ($request->attendances as $studentId => $data) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'date' => $request->date,
                ],
                [
                    'status' => $data['status'],
                    'note' => $data['note'] ?? null,
                ]
            );
        }

        return redirect()->back()->with('success', 'Émargement enregistré.');
    }

    public function history(Request $request)
    {
        $classes = SchoolClass::all();
        $query = Attendance::with('student.schoolClass')->latest();

        if ($request->filled('class_id')) {
            $query->whereHas('student', function ($q) use ($request) {
                $q->where('class_id', $request->class_id);
            });
        }

        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->where('date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->where('date', '<=', $request->date_to);
        }

        return view('attendances.history', [
            'attendances' => $query->paginate(20),
            'classes' => $classes,
            'filters' => $request->all(),
        ]);
    }
}
