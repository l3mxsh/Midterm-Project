<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentsController extends Controller
{
    public function __invoke(Request $request)
    {
        $search = $request->input('search');
        $students = Student::query()
            ->when(
                $search,
                fn($q) =>
                $q->where(
                    fn($q) =>
                    $q->where('fname', 'like', "%$search%")
                        ->orWhere('student_number', 'like', "%$search%")
                        ->orWhere('program', 'like', "%$search%")
                        ->orWhere('mname', 'like', "%$search%")
                        ->orWhere('lname', 'like', "%$search%")
                )
            )
            ->get();
        return view('Dashboard/student', compact('students', 'search'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'fname'                 => 'required|string|max:255',
            'mname'                 => 'nullable|string|max:255',
            'lname'                 => 'required|string|max:255',
            'age'                   => 'required|integer|between:18,100',
            'address'               => 'required|string|max:255',
            'gender'                => 'required|in:Male,Female',
            'program' => 'required|in:BSIT,BSCS,BSBA,BSA,BSN,BS Pharmacy,BA Comm,BA Psych,BSCE,BS Arch',
        ]);


        $student = Student::create([
            'fname'     => $request->fname,
            'mname'     => $request->mname,
            'lname'     => $request->lname,
            'age'     => $request->age,
            'address'  => $request->address,
            'gender'   => $request->gender,
            'program'   => $request->program,
        ]);
        return redirect('/dashboard/student')->with('success', 'Student Registration successful.');
    }
    public function update(Request $request, Student $student)
    {

        $data = $request->validate([
            'fname'                 => 'required|string|max:255',
            'mname'                 => 'nullable|string|max:255',
            'lname'                 => 'required|string|max:255',
            'age'                   => 'required|integer|between:18,100',
            'address'               => 'required|string|max:255',
            'gender'                => 'required|in:Male,Female',
            'program' => 'required|in:BSIT,BSCS,BSBA,BSA,BSN,BS Pharmacy,BA Comm,BA Psych,BSCE,BS Arch',
        ], [
            'age.between'       => 'Age must be 18 or above.',
        ]);

        $student->update($data);
        return redirect('/dashboard/student')->with('success', "{$student->fname} updated successfully.");
    }
    public function delete(Student $student)
    {
        $student->delete();
        return redirect('/dashboard/student')->with('success-red',  "{$student->fname} deleted successfully.");
    }
}
