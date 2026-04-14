<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $totalUsers    = User::count();
        $totalStudents = Student::count();
        $maleStudents   = Student::where('gender', 'Male')->count();
        $femaleStudents = Student::where('gender', 'Female')->count();

        $studentsByProgram = Student::selectRaw('program, count(*) as total')
            ->groupBy('program')
            ->pluck('total', 'program');

        return view('Dashboard/dashboard', compact(
            'totalUsers',
            'totalStudents',
            'maleStudents',
            'femaleStudents',
            'studentsByProgram'
        ));
    }
}
