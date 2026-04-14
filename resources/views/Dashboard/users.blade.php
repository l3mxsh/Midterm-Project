@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

    <h4 class="fw-bold mb-4">User Management</h4>
    <div class="d-flex flex-row gap-2">
        <form method="GET" action="{{ route('dashboard.users') }}" class="w-100 d-flex flex-row gap-2">
            <input type="text" name="search" value="{{ $search ?? '' }}" class="form-control mb-3 shadow-sm"
                placeholder="Search users...">
            <button class="btn btn-outline-dark mb-3 shadow-sm">
                <i class="bi bi-search"></i>
            </button>
        </form>
        <button class="btn btn-dark mb-3 shadow-sm" style="width: 150px;" data-bs-toggle="modal"
            data-bs-target="#userAddModal">
            <i class="bi bi-plus"></i> Add User
        </button>
    </div>


    <table class="table table-striped shadow-sm text-center table-hover">
        <thead>
            <tr class="">
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Full Name</th>
                <th scope="col">Email</th>
                <th scope="col">Address</th>
                <th scope="col">Gender</th>
                <th scope="col">Date Created</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody class="">
            @if (!$users->isEmpty())
                @foreach ($users as $user)
                    <tr class="">
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        <td>
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
    @if ($users->isEmpty())
        <div class="w-100 text-center mt-5 fs-4 fw-bold">No Other Users found</div>
    @endif
    @include('modals.users.edit-user')
    @include('modals.users.delete-user')
    @include('modals.users.add-user')
@endsection