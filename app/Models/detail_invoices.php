<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class detail_invoices extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_items',
        'id_invoices',
        'id_users',
        'name',
        'quantity',
        'subtotal'
    ];

    /**
     * Define a relationship with Item
     * Detail_invoices can have many items
     *
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    public function invoice()
    {
        return $this->belongsTo(invoices::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
