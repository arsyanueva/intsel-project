@extends('layouts.admin')

@section('title', 'Categories')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h3 class="mb-1">Categories</h3>
                        <p class="text-muted mb-0">
                            Manage all product categories
                        </p>
                    </div>
                    <div class="d-flex">
                        <a href="{{ route('categories.create') }}" class="btn btn-primary">
                            + Add Category
                        </a>
                        <div class="btn-group ms-2">
                            <a href="{{ route('categories.export.pdf') }}" class="btn btn-outline-secondary btn-sm">Export PDF</a>
                            <a href="{{ route('categories.export.excel') }}" class="btn btn-outline-success btn-sm">Export Excel</a>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-4">
                        <form method="GET" action="{{ route('categories.index') }}">
                            <label for="category-search" class="form-label">Search category</label>
                            <div class="input-group">
                                <input
                                    id="category-search"
                                    name="search"
                                    type="text"
                                    class="form-control"
                                    value="{{ request('search') }}"
                                    placeholder="Search category...">
                                @if(request('search'))
                                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
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
                                <th>Category Name</th>
                                <th style="width:180px;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td>{{ $categories->firstItem() + $loop->index }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">
                                            Edit
                                        </a>

                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this category?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No category found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $categories->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
