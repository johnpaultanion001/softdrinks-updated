<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingReturnedProduct extends Model
{
    use HasFactory;
    public $table = 'pending_returned_products';

    protected $fillable = [
        'purchase_order_number_id',
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
    public function purchase_order()
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_number_id', 'purchase_order_number');
    }
    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'product_id', 'product_id');
    }
   
}
