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
        'type_of_return',
    ];
   

    public function status()
    {
        return $this->belongsTo(StatusReturn::class, 'status_id');
    }
    public function empty_inventory()
    {
        return $this->belongsTo(EmptyBottlesInventory::class, 'product_id', 'product_id');
    }
    public function bad_order()
    {
        return $this->belongsTo(LocationProduct::class, 'product_id', 'product_id')->where('location_id', 3);
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
