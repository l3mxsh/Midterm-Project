@extends('layouts.dashboard')

@section('title', 'Students')

@section('content')
    <h4 class="fw-bold mb-4">Students Records</h4>
    <div class="d-flex flex-row gap-2">
        <form method="GET" action="{{ route('dashboard.student') }}" class="w-100 d-flex flex-row gap-2">
            <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control mb-3 shadow-sm"
                placeholder="Search students...">
            <button class="btn btn-outline-dark mb-3 shadow-sm">
                <i class="bi bi-search"></i>
            </button>
        </form>
        <button class="btn btn-dark mb-3 shadow-sm" style="width: 150px;" data-bs-toggle="modal"
            data-bs-target="#studentAddModal">
            <i class="bi bi-plus"></i> Add Student
        </button>
    </div>
    <div class="">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Student No.</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Middle Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Address</th>
                    <th scope="col">Program</th>
                    <th scope="col">Date Created</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="">
                @if (!$students->isEmpty())
                    @foreach ($students as $student)
                        <tr class="">
                            <td>{{ $loop->iteration}}</td>
                            <td>{{ $student->student_number }}</td>
                            <td>{{ $student->fname}}</td>
                            <td>{{ $student->mname}}</td>
                            <td>{{ $student->lname}}</td>
                            <td>{{ $student->age}}</td>
                            <td>{{ $student->gender}}</td>
                            <td>{{ $student->address}}</td>
                            <td>{{ $student->program}}</td>
                            <td>{{ $student->created_at->format('Y-m-d') }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#studentEditModal"
                                    data-id="{{ $student->id }}" data-fname="{{ $student->fname }}"
                                    data-mname="{{ $student->mname }}" data-lname="{{ $student->lname }}"
                                    data-age="{{ $student->age }}" data-address="{{ $student->address }}"
                                    data-gender="{{ $student->gender }}" data-program="{{ $student->program }}">

                                    <i class="bi bi-pencil"></i>
                                </button>

                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#studentDeleteModal" data-id="{{ $student->id }}" data-name="{{ $student->fname }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    @if ($students->isEmpty())
        <div class="w-100 text-center mt-5 fs-4 fw-bold">No Students found</div>
    @endif

    @include('modals.students.delete-student')
    @include('modals.students.edit-student')
    @include('modals.students.add-student')
@endsection