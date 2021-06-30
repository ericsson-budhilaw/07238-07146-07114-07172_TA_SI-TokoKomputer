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

    public function detail_invoices()
    {
        return $this->hasMany(detail_invoices::class, 'id_invoices');
    }
}
