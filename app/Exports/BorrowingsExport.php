<?php

namespace App\Exports;

use App\Models\Borrowing;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BorrowingsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Borrowing::with(['user', 'details'])
            ->get()
            ->map(function ($borrowing) {
                return [
                    'Borrower' => $borrowing->user->name,
                    'Borrow Date' => $borrowing->borrow_date->format('d M Y'),
                    'Return Date' => $borrowing->return_date?->format('d M Y') ?? '-',
                    'Status' => $borrowing->status,
                    'Total Quantity' => $borrowing->details->sum('quantity'),
                ];
            });
    }

    public function headings(): array
    {
        return ['Borrower', 'Borrow Date', 'Return Date', 'Status', 'Total Quantity'];
    }
}
