<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use App\Models\Course;
use App\Models\Student;
use App\Models\Exam;
use App\Models\Grade;
use App\Models\Attendance;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $classData = [
            'Développement Web' => ['HTML/CSS', 'Laravel', 'SQL'],
            'Design Graphique' => ['Photoshop', 'Illustrator', 'UI/UX'],
        ];

        foreach ($classData as $className => $courses) {
            $class = SchoolClass::create(['name' => $className]);

            foreach ($courses as $courseName) {
                $course = Course::create([
                    'name' => $courseName,
                    'class_id' => $class->id,
                ]);

                // 2 exams per course
                for ($i = 1; $i <= 2; $i++) {
                    $exam = Exam::create([
                        'title' => "Examen $i de $courseName",
                        'course_id' => $course->id,
                        'exam_date' => Carbon::now()->subDays(rand(10, 20)),
                        'coefficient' => rand(1, 3),
                    ]);
                }
            }

            // 5 realistic students per class
            $studentNames = [
                ['Jean', 'Dupont'], ['Marie', 'Curie'], ['Pierre', 'Martin'], ['Sophie', 'Bernard'], ['Lucas', 'Petit']
            ];

            foreach ($studentNames as $name) {
                $student = Student::create([
                    'first_name' => $name[0],
                    'last_name' => $name[1],
                    'class_id' => $class->id,
                ]);

                // Grades for each student for all exams in that class
                $allExams = Exam::whereHas('course', function($q) use ($class) {
                    $q->where('class_id', $class->id);
                })->get();

                foreach ($allExams as $exam) {
                    Grade::create([
                        'student_id' => $student->id,
                        'exam_id' => $exam->id,
                        'score' => rand(8, 18),
                    ]);
                }

                // Attendances for last 3 days
                for ($i = 0; $i < 3; $i++) {
                    Attendance::create([
                        'student_id' => $student->id,
                        'date' => Carbon::now()->subDays($i),
                        'status' => ['present', 'absent', 'late'][rand(0, 2)],
                        'note' => rand(0, 1) ? 'Justifié' : null,
                    ]);
                }
            }
        }
    }
}
