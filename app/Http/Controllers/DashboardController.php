<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalProducts = Product::count();

        $borrowed = Borrowing::where('status', 'Borrowed')->count();

        $totalStock = Product::sum('stock');

        $borrowedQuantity = BorrowingDetail::join('borrowings', 'borrowings.id', '=', 'borrowing_details.borrowing_id')
            ->where('borrowings.status', 'Borrowed')
            ->sum('borrowing_details.quantity');

        $available = max(0, $totalStock - $borrowedQuantity);

        $lowStockProducts = Product::with('category')->get()->filter(function ($product) {
            return $product->available_stock <= config('inventory.low_stock_threshold');
        });

        $lowStockCount = $lowStockProducts->count();

        $recentBorrowings = Borrowing::with('user')
            ->latest()
            ->take(5)
            ->get();

        $recentProducts = Product::with('category')
            ->latest()
            ->take(5)
            ->get();

        $monthlyBorrowings = Borrowing::whereYear('borrow_date', now()->year)
            ->get()
            ->groupBy(function (Borrowing $borrowing) {
                return (int) $borrowing->borrow_date->format('n');
            })
            ->map(fn ($group) => $group->count());

        $months = [];
        $totals = [];

        for ($i = 1; $i <= 12; $i++) {
            $months[] = date('M', mktime(0, 0, 0, $i, 1));
            $totals[] = $monthlyBorrowings[$i] ?? 0;
        }

        return view('dashboard.index', compact(
            'totalProducts',
            'borrowed',
            'available',
            'recentBorrowings',
            'recentProducts',
            'months',
            'totals',
            'lowStockCount',
            'lowStockProducts'
        ));
    }
}
