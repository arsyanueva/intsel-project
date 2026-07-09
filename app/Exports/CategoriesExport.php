<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoriesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Category::all()->map(function ($category) {
            return [
                'Name' => $category->name,
                'Created At' => $category->created_at->format('d M Y'),
            ];
        });
    }

    public function headings(): array
    {
        return ['Name', 'Created At'];
    }
}
