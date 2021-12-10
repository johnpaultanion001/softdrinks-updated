<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecieveReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'receiving_good_id',
        'product_id',
        'return_qty',
        'unit_price',
        'amount',
        'status_id',
        'remarks',
    ];
   

    public function status()
    {
        return $this->belongsTo(StatusReturn::class, 'status_id');
    }
    public function empty_inventory()
    {
        return $this->belongsTo(EmptyBottlesInventory::class, 'product_id', 'product_id');
    }
    public function product()
    {
        return $this->belongsTo(SalesInventory::class, 'product_id');
    }
    public function receiving_good()
    {
       return $this->belongsTo(ReceivingGood::class, 'receiving_good_id');
    }
}
