<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UCS extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_order_number_id',
        'product_id',
        'ucs',
        'qty',
        'isRemove',
        'isPurchase',
        'ucs_size',
        'isHide',


    ];

    public function purchase_order()
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_number_id', 'purchase_order_number');
    }
    public function inventory()
    {
        return $this->belongsTo(Inventory::class,'product_id' , 'product_id');
    }

}
