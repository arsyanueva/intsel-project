<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Product;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BorrowingController extends Controller
{
    public function index(Request $request): View
    {
        $query = Borrowing::with(['user', 'details.product'])
            ->join('users', 'users.id', '=', 'borrowings.user_id')
            ->orderBy('users.name')
            ->select('borrowings.*');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($query) use ($search) {
                $query->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->orWhere('status', 'like', "%{$search}%");
            });
        }

        $borrowings = $query->paginate(10);

        return view('borrowings.index', compact('borrowings'));
    }

    public function exportPdf(): \Illuminate\Http\Response
    {
        $borrowings = Borrowing::with(['user', 'details.product'])
            ->orderBy('borrow_date', 'desc')
            ->get();

        $pdf = Pdf::loadView('borrowings.export-pdf', compact('borrowings'));

        return $pdf->download('borrowings.pdf');
    }

    public function exportExcel(): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $borrowings = Borrowing::with(['user', 'details'])
            ->orderBy('borrow_date', 'desc')
            ->get()
            ->map(function ($borrowing) {
                return [
                    'Borrower' => $borrowing->user->name,
                    'Borrow Date' => $borrowing->borrow_date->format('d M Y'),
                    'Return Date' => $borrowing->return_date?->format('d M Y') ?? '-',
                    'Status' => $borrowing->status,
                    'Total Quantity' => $borrowing->details->sum('quantity'),
                ];
            })
            ->toArray();

        return $this->downloadExcelSpreadsheet('borrowings', $borrowings);
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
