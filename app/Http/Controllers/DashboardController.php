<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Borrowing;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalProducts = Product::count();

        $borrowed = Borrowing::where('status', 'Borrowed')->count();

        $available = Product::sum('stock');

        $recentBorrowings = Borrowing::with('user')
            ->latest()
            ->take(5)
            ->get();

        $recentProducts = Product::with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalProducts',
            'borrowed',
            'available',
            'recentBorrowings',
            'recentProducts'
        ));
    }
}
