@extends('layouts.dashboard')

@section('title', 'Students')

@section('content')
    <h4 class="fw-bold mb-4">Students Records</h4>

    {{-- Search + Add --}}
    <div class="d-flex flex-column flex-sm-row gap-2 mb-3">
        <form method="GET" action="{{ route('dashboard.student') }}" class="d-flex gap-2 flex-grow-1">
            <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control shadow-sm"
                placeholder="Search students...">
            <button class="btn btn-outline-dark shadow-sm flex-shrink-0">
                <i class="bi bi-search"></i>
            </button>
        </form>
        <button class="btn btn-dark shadow-sm flex-shrink-0" data-bs-toggle="modal" data-bs-target="#studentAddModal">
            <i class="bi bi-plus"></i> <span>Add Student</span>
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-striped shadow-sm text-center table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Student No.</th>
                    <th scope="col">First Name</th>
                    <th scope="col" class="d-none d-md-table-cell">Middle Name</th>
                    <th scope="col" class="d-none d-md-table-cell">Last Name</th>
                    <th scope="col" class="d-none d-sm-table-cell">Age</th>
                    <th scope="col" class="d-none d-sm-table-cell">Gender</th>
                    <th scope="col" class="d-none d-lg-table-cell">Address</th>
                    <th scope="col" class="d-none d-md-table-cell">Program</th>
                    <th scope="col" class="d-none d-lg-table-cell">Date Created</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (!$students->isEmpty())
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $student->student_number }}</td>
                            <td>{{ $student->fname }}</td>
                            <td class="d-none d-md-table-cell">{{ $student->mname }}</td>
                            <td class="d-none d-md-table-cell">{{ $student->lname }}</td>
                            <td class="d-none d-sm-table-cell">{{ $student->age }}</td>
                            <td class="d-none d-sm-table-cell">{{ $student->gender }}</td>
                            <td class="d-none d-lg-table-cell">{{ $student->address }}</td>
                            <td class="d-none d-md-table-cell">{{ $student->program }}</td>
                            <td class="d-none d-lg-table-cell">{{ $student->created_at->format('Y-m-d') }}</td>
                            <td class="text-nowrap">
                                <button class="btn btn-sm btn-outline-dark" data-bs-toggle="modal"
                                    data-bs-target="#studentEditModal"
                                    data-id="{{ $student->id }}" data-fname="{{ $student->fname }}"
                                    data-mname="{{ $student->mname }}" data-lname="{{ $student->lname }}"
                                    data-age="{{ $student->age }}" data-address="{{ $student->address }}"
                                    data-gender="{{ $student->gender }}" data-program="{{ $student->program }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#studentDeleteModal" data-id="{{ $student->id }}"
                                    data-name="{{ $student->fname }}">
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

    @include('Modals.Students.delete-student')
    @include('Modals.Students.edit-student')
    @include('Modals.Students.add-student')
@endsection
