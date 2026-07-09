@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="row mb-4">
    <div class="col-lg-12">
        <h3 class="mb-1">Dashboard</h3>
        <p class="text-muted">
            Welcome back, {{ Auth::user()->name }}
        </p>
    </div>
</div>

@if($lowStockCount > 0)
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="alert alert-warning">
                <strong>Low stock alert:</strong>
                {{ $lowStockCount }} product(s) have available stock at or below {{ config('inventory.low_stock_threshold') }}.
                <a href="{{ route('products.index') }}" class="alert-link">Review products</a>
            </div>
        </div>
    </div>
@endif

{{-- Statistic Cards --}}
<div class="row">

    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted mb-2">
                    Total Products
                </h6>

                <h2 class="mb-0">
                    {{ $totalProducts }}
                </h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted mb-2">
                    Borrowed
                </h6>

                <h2 class="mb-0">
                    {{ $borrowed }}
                </h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted mb-2">
                    Available Stock
                </h6>

                <h2 class="mb-0">
                    {{ $available }}
                </h2>
            </div>
        </div>
    </div>

</div>

<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">
                    Monthly Borrowing Trends
                </h4>

                <div style="position: relative; height: 350px; width: 100%;">
                    <canvas id="borrowingChart"></canvas>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">

    {{-- Recent Borrowings --}}
    <div class="col-lg-7">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    Recent Borrowings
                </h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Borrower</th>
                                <th>Borrow Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                        @forelse($recentBorrowings as $borrowing)

                            <tr>
                                <td>
                                    {{ $borrowing->user->name }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($borrowing->borrow_date)->format('d M Y') }}
                                </td>
                                <td>
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
                        @empty

                            <tr>
                                <td colspan="3" class="text-center text-muted">
                                    No borrowing data.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Products --}}
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    Recently Added Products
                </h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>

                        @forelse($recentProducts as $product)
                            <tr>
                                <td>
                                    {{ $product->code }}
                                </td>
                                <td>
                                    {{ $product->name }}
                                </td>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $product->available_stock }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">
                                    No product data.
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('borrowingChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($months),
        datasets: [{
            label: 'Borrowings',
            data: @json($totals),
            borderWidth: 3,
            tension: 0.3,
            fill: false
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>
@endpush

@endsection
