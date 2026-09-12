<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('students.index', ['students' => Student::with('schoolClass')->get()]);
    }

    public function create()
    {
        return view('students.create', ['classes' => SchoolClass::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'class_id' => 'required|exists:school_classes,id',
        ]);
        Student::create($request->all());
        return redirect()->route('students.index')->with('success', 'Étudiant enregistré.');
    }

    public function edit(Student $student)
    {
        return view('students.edit', [
            'student' => $student,
            'classes' => SchoolClass::all(),
        ]);
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'class_id' => 'required|exists:school_classes,id',
        ]);
        $student->update($request->all());
        return redirect()->route('students.index')->with('success', 'Étudiant mis à jour.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Étudiant supprimé.');
    }

    public function show(Student $student)
    {
        $student->load(['schoolClass', 'attendances', 'grades.exam.course']);

        $absences = $student->attendances->where('status', 'absent')->count();
        $retards = $student->attendances->where('status', 'late')->count();
        
        $totalPoints = 0;
        $totalCoeff = 0;
        foreach ($student->grades as $grade) {
            $coeff = $grade->exam->coefficient;
            $totalPoints += ($grade->score * $coeff);
            $totalCoeff += $coeff;
        }
        $moyenne = $totalCoeff > 0 ? round($totalPoints / $totalCoeff, 2) : 'N/A';

        return view('students.show', [
            'student' => $student,
            'absences' => $absences,
            'retards' => $retards,
            'moyenne' => $moyenne,
        ]);
    }
}
