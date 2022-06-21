<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesPallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'salesinvoice_id',
        'pallet_id',
        'type',
        'qty',
        'unit_price',
        'amount',
    ];
    public function pallet()
    {
        return $this->belongsTo(Pallet::class, 'pallet_id');
    }
}
