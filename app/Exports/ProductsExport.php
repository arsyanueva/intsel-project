<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Product::with('category')
            ->get()
            ->map(function ($product) {
                return [
                    'Code' => $product->code,
                    'Name' => $product->name,
                    'Category' => $product->category->name ?? '-',
                    'Available Stock' => max(0, $product->stock - $product->borrowingDetails()->whereHas('borrowing', function ($query) {
                        $query->where('status', 'Borrowed');
                    })->sum('quantity')),
                    'Condition' => $product->condition,
                    'Location' => $product->location,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Code',
            'Name',
            'Category',
            'Available Stock',
            'Condition',
            'Location',
        ];
    }
}
