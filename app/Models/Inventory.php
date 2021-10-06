<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    public $table = 'inventories';

    protected $fillable = [
        'category_id',
        'purchase_order_number_id',

        'product_code',
        'long_description',
        'short_description',
        
        'stock',
        'qty',
        'pqty',
        'sold',
        'orders',

        'size_id',

        'purchase_amount',
        'profit',
        'price',
        
        'total_amount_purchase',
        'total_profit',
        'total_price',

        'expiration',
        'product_remarks',
        'location_id',
        'product_id',
        'supplier_id',
        'isRemove',
        'isSame',
        'add_qty',
        'ucs_size'
       
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function purchase_order()
    {
       return $this->belongsTo(PurchaseOrder::class, 'purchase_order_number_id', 'purchase_order_number');
    }
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    
}
