@extends('layouts.admin')

@section('title', 'Products')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h3 class="mb-1">Products</h3>
                        <p class="text-muted">Manage inventory products</p>
                    </div>
                    <div class="d-flex">
                        <a href="{{ route('products.create') }}" class="btn btn-primary">
                            + Add Product
                        </a>
                        <div class="btn-group ms-2">
                            <a href="{{ route('products.export.pdf') }}" class="btn btn-outline-secondary btn-sm">Export PDF</a>
                            <a href="{{ route('products.export.excel') }}" class="btn btn-outline-success btn-sm">Export Excel</a>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="row mb-3">
                    <div class="col-md-4">
                        <form method="GET" action="{{ route('products.index') }}">
                            <label for="product-search" class="form-label">Search product</label>
                            <div class="input-group">
                                <input
                                    id="product-search"
                                    name="search"
                                    type="text"
                                    class="form-control"
                                    value="{{ request('search') }}"
                                    placeholder="Search product...">
                                @if(request('search'))
                                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Clear</a>
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
                                <th>Image</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Available Stock</th>
                                <th>Condition</th>
                                <th>Location</th>
                                <th style="width:180px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $products->firstItem() + $loop->index }}</td>
                                    <td>
                                        @if($product->image)
                                            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" style="max-width: 80px;">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $product->code }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name ?? '-' }}</td>
                                    <td>
                                        {{ max(0, $product->stock - ($product->borrowed_quantity ?? 0)) }}
                                        @if(max(0, $product->stock - ($product->borrowed_quantity ?? 0)) <= config('inventory.low_stock_threshold'))
                                            <span class="badge bg-danger ms-1">Low stock</span>
                                        @endif
                                    </td>
                                    <td>{{ $product->condition }}</td>
                                    <td>{{ $product->location }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No product found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $products->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
