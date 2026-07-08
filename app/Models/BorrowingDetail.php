<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BorrowingDetail extends Model
{
    protected $fillable = [
        'borrowing_id',
        'product_id',
        'quantity',
    ];

    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
