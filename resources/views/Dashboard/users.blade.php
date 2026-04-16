@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

    <h4 class="fw-bold mb-4">User Management</h4>

    {{-- Search + Add --}}
    <div class="d-flex flex-column flex-sm-row gap-2 mb-3">
        <form method="GET" action="{{ route('dashboard.users') }}" class="d-flex gap-2 flex-grow-1">
            <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control shadow-sm"
                placeholder="Search users...">
            <button class="btn btn-outline-dark shadow-sm flex-shrink-0">
                <i class="bi bi-search"></i>
            </button>
        </form>
        <button class="btn btn-dark shadow-sm flex-shrink-0" data-bs-toggle="modal" data-bs-target="#userAddModal">
            <i class="bi bi-plus"></i> <span>Add User</span>
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-striped shadow-sm text-center table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ID</th>
                    <th scope="col">Full Name</th>
                    <th scope="col" class="d-none d-md-table-cell">Email</th>
                    <th scope="col" class="d-none d-lg-table-cell">Address</th>
                    <th scope="col" class="d-none d-sm-table-cell">Gender</th>
                    <th scope="col" class="d-none d-lg-table-cell">Date Created</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (!$users->isEmpty())
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td class="d-none d-md-table-cell">{{ $user->email }}</td>
                            <td class="d-none d-lg-table-cell">{{ $user->address }}</td>
                            <td class="d-none d-sm-table-cell">{{ $user->gender }}</td>
                            <td class="d-none d-lg-table-cell">{{ $user->created_at->format('Y-m-d') }}</td>
                            <td class="text-nowrap">
                                <button class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#userEditModal"
                                    data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}"
                                    data-address="{{ $user->address }}" data-gender="{{ $user->gender }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#userDeleteModal" data-id="{{ $user->id }}" data-name="{{ $user->name }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    @if ($users->isEmpty())
        <div class="w-100 text-center mt-5 fs-4 fw-bold">No Other Users found</div>
    @endif

    @include('Modals.Users.edit-user')
    @include('Modals.Users.delete-user')
    @include('Modals.Users.add-user')
@endsection