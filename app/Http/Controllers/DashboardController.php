<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Course;
use App\Models\Attendance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $classesCount = SchoolClass::count();
        $studentsCount = Student::count();
        $coursesCount = Course::count();
        
        $totalAttendances = Attendance::count();
        $presents = Attendance::where('status', 'present')->count();
        $attendanceRate = $totalAttendances > 0 ? round(($presents / $totalAttendances) * 100) : 0;

        return view('dashboard', compact('classesCount', 'studentsCount', 'coursesCount', 'attendanceRate'));
    }
}
