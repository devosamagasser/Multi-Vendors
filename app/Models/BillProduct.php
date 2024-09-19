<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BillProduct extends Pivot
{
    use HasFactory;

    protected $table = 'bill_products';

    public $timestamps = false;

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault();
    }
}
