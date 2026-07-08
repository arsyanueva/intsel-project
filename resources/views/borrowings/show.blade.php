@extends('layouts.admin')

@section('title', 'Borrowing Detail')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="mb-1">Borrowing Detail</h3>
                        <p class="text-muted mb-0">
                            View borrowing transaction information
                        </p>
                    </div>

                    <a href="{{ route('borrowings.index') }}"
                        class="btn btn-secondary">
                        Back
                    </a>

                </div>

                <hr>

                {{-- Borrowing Information --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 180px">Borrower</th>
                                <td>: {{ $borrowing->user->name }}</td>
                            </tr>
                            <tr>
                                <th>Borrow Date</th>
                                <td>: {{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d M Y') }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 180px">Return Date</th>
                                <td>:
                                    {{ $borrowing->return_date
                                        ? \Carbon\Carbon::parse($borrowing->return_date)->format('d M Y')
                                        : '-' }}
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>:
                                    @if($borrowing->status == 'Borrowed')
                                        <span class="badge bg-warning">
                                            Borrowed
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            Returned
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                {{-- Borrowed Products --}}
                <h5 class="mb-3">
                    Borrowed Products
                </h5>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th style="width: 60px">No</th>
                                <th style="width: 150px">Product Code</th>
                                <th>Product Name</th>
                                <th style="width: 120px ">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($borrowing->details as $detail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $detail->product->code }}</td>
                                <td>{{ $detail->product->name }}</td>
                                <td>{{ $detail->quantity }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"
                                    class="text-center">
                                    No products found.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
