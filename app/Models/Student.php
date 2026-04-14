<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'student_number',
        'fname',
        'mname',
        'lname',
        'age',
        'gender',
        'address',
        'program'
    ];

    protected static function booted(): void
    {
        static::creating(function (Student $student) {
            $student->student_number = self::generateStudentNumber();
        });
    }

    private static function generateStudentNumber(): string
    {
        $year = now()->year;

        $last = self::whereYear('created_at', $year)
            ->orderByDesc('student_number')
            ->value('student_number');

        $next = $last ? (int) substr($last, 4) + 1 : 1;

        return $year . str_pad($next, 4, '0', STR_PAD_LEFT);
    }
}
