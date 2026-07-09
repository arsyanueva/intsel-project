@extends('layouts.admin')

@section('title','Borrowings')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h3 class="mb-1">Borrowings</h3>
                        <p class="text-muted mb-0">Manage borrowing transactions</p>
                    </div>
                    <div class="d-flex">
                        <a href="{{ route('borrowings.create') }}" class="btn btn-primary">
                            + New Borrowing
                        </a>
                        <div class="btn-group ms-2">
                            <a href="{{ route('borrowings.export.pdf') }}" class="btn btn-outline-secondary btn-sm">Export PDF</a>
                            <a href="{{ route('borrowings.export.excel') }}" class="btn btn-outline-success btn-sm">Export Excel</a>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-4">
                        <form method="GET" action="{{ route('borrowings.index') }}">
                            <label for="borrowing-search" class="form-label">Search borrowing</label>
                            <div class="input-group">
                                <input
                                    id="borrowing-search"
                                    name="search"
                                    type="text"
                                    class="form-control"
                                    value="{{ request('search') }}"
                                    placeholder="Search borrowing...">
                                @if(request('search'))
                                    <a href="{{ route('borrowings.index') }}" class="btn btn-outline-secondary">
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
                                <th style="width:50px;">No</th>
                                <th>Borrower</th>
                                <th>Borrow Date</th>
                                <th>Return Date</th>
                                <th>Status</th>
                                <th style="width:180px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($borrowings as $borrowing)
                                <tr>
                                    <td>{{ $borrowings->firstItem() + $loop->index }}</td>
                                    <td>{{ $borrowing->user->name ?? '-' }}</td>
                                    <td>{{ $borrowing->borrow_date?->format('d F Y') ?? '-' }}</td>
                                    <td>{{ $borrowing->return_date?->format('d F Y') ?? '-' }}</td>
                                    <td>{{ $borrowing->status }}</td>
                                    <td>
                                        <a href="{{ route('borrowings.show', $borrowing) }}" class="btn btn-sm btn-info">
                                            View
                                        </a>

                                        <a href="{{ route('borrowings.edit', $borrowing) }}" class="btn btn-sm btn-warning">
                                            Edit
                                        </a>

                                        <form action="{{ route('borrowings.destroy', $borrowing) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this borrowing?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No borrowing found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $borrowings->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
