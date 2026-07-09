<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BorrowingController extends Controller
{
    public function index(): View
    {
        $borrowings = Borrowing::with(['user', 'details.product'])->latest()->paginate(10);

        return view('borrowings.index', compact('borrowings'));
    }

    public function create(): View
    {
        $users = User::orderBy('name')->get();
        $products = Product::orderBy('name')->get();

        $borrowing = new Borrowing();

        return view('borrowings.create', compact(
            'users',
            'products',
            'borrowing'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'borrow_date' => ['required', 'date'],
            'return_date' => ['nullable', 'date'],
            'status' => ['required', 'in:Borrowed,Returned'],
            'details' => ['required', 'array', 'min:1'],
            'details.*.product_id' => ['required', 'exists:products,id'],
            'details.*.quantity' => ['required', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($validated) {
            $borrowing = Borrowing::create([
                'user_id' => $validated['user_id'],
                'borrow_date' => $validated['borrow_date'],
                'return_date' => $validated['return_date'] ?? null,
                'status' => $validated['status'],
            ]);

            $details = collect($validated['details'])->map(function ($item) use ($borrowing) {
                return [
                    'borrowing_id' => $borrowing->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            })->toArray();

            BorrowingDetail::insert($details);
        });

        return redirect()->route('borrowings.index')
            ->with('success', 'Borrowing saved successfully.');
    }

    public function show(Borrowing $borrowing): View
    {
        $borrowing->load(['user', 'details.product']);

        return view('borrowings.show', compact('borrowing'));
    }

    public function edit(Borrowing $borrowing): View
    {
        $users = User::orderBy('name')->get();
        $products = Product::orderBy('name')->get();

        $borrowing->load('details.product');

        return view('borrowings.edit', compact('borrowing', 'users', 'products'));
    }

    public function update(Request $request, Borrowing $borrowing): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'borrow_date' => ['required', 'date'],
            'return_date' => ['nullable', 'date'],
            'status' => ['required', 'in:Borrowed,Returned'],
            'details' => ['required', 'array', 'min:1'],
            'details.*.product_id' => ['required', 'exists:products,id'],
            'details.*.quantity' => ['required', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($validated, $borrowing) {
            $borrowing->update([
                'user_id' => $validated['user_id'],
                'borrow_date' => $validated['borrow_date'],
                'return_date' => $validated['return_date'] ?? null,
                'status' => $validated['status'],
            ]);

            $borrowing->details()->delete();

            $details = collect($validated['details'])->map(function ($item) use ($borrowing) {
                return [
                    'borrowing_id' => $borrowing->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            })->toArray();

            BorrowingDetail::insert($details);
        });

        return redirect()->route('borrowings.index')
            ->with('success', 'Borrowing updated successfully.');
    }

    public function destroy(Borrowing $borrowing): RedirectResponse
    {
        $borrowing->delete();

        return redirect()->route('borrowings.index')
            ->with('success', 'Borrowing deleted successfully.');
    }
}
