<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = [
        'seller_id',
        'sale_date',
        'sale_price',
        'commission',
    ];

    public function seller(): BelongsTo
    {

        return $this->belongsTo(Seller::class);
    }
}
