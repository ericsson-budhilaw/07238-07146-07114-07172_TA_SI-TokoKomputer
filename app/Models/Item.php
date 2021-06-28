<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'subtotal',
        'stok',
        'thumbnail'
    ];

    public function format_uang($angka){
        $hasil = "Rp." . number_format($angka,0, ',' , '.');
        return $hasil;
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('name', 'like', '%'.$query.'%');
    }

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
