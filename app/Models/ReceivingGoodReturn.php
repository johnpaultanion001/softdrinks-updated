<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivingGoodReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'receiving_good_id',
        'product_id',
        'qty',
        'unit_price',
        'amount',
        'status_id',
        'remarks',
        'isRemove',
    ];
    public function status()
    {
        return $this->belongsTo(StatusReturn::class, 'status_id');
    }
    public function receiving_good()
    {
       return $this->belongsTo(ReceivingGood::class, 'receiving_good_id');
    }
    public function product_return()
    {
        return $this->belongsTo(SalesInventory::class, 'product_id');
    }
   
}
