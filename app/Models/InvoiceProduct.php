<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceProduct extends Model
{
    protected $fillable = [
        'qty',
        'sale_price',
        'user_id',
        'invoice_id',
        'product_id',
    ];
    public function product(): BelongsTo{
        return $this->belongsTo(Product::class);
    }
    public function invoice(): BelongsTo{
        return $this->belongsTo(Invoice::class);
    }
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
