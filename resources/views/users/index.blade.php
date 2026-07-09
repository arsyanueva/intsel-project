@extends('layouts.admin')

@section('title','Users')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h3 class="mb-1">Users</h3>
                        <p class="text-muted">
                            Manage system users
                        </p>
                    </div>
                    <div class="d-flex">
                        <a href="{{ route('users.create') }}" class="btn btn-primary">
                            + Add User
                        </a>
                        <div class="btn-group ms-2">
                            <a href="{{ route('users.export.pdf') }}" class="btn btn-outline-secondary btn-sm">Export PDF</a>
                            <a href="{{ route('users.export.excel') }}" class="btn btn-outline-success btn-sm">Export Excel</a>
                        </div>
                    </div>

                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-4">
                        <form method="GET" action="{{ route('users.index') }}">
                            <label for="user-search" class="form-label">Search users</label>
                            <div class="input-group">
                                <input
                                    id="user-search"
                                    name="search"
                                    type="text"
                                    class="form-control"
                                    value="{{ request('search') }}"
                                    placeholder="Search users...">
                                @if(request('search'))
                                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                                        Clear
                                    </a>
                                @endif
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th style="width: 180px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $users->firstItem() + $loop->index }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $user->role->name }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('users.edit',$user) }}"
                                        class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('users.destroy',$user) }}"
                                        method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            onclick="return confirm('Delete user?')"
                                            class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    No users found.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $users->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
