<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class invoices extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_date',
        'remarks',
        'status_payment',
        'total'
    ];

    /**
     * Many users belongs to detail_invocese
     *
     * @return BelongsTo
     */
    public function detail_invoice(): BelongsTo
    {
        return $this->belongsTo(detail_invoices::class);
    }
}
