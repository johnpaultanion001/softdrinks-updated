<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    public $table = 'purchase_orders';

    protected $fillable = [
        'user_id',
        'purchase_order_number',
        'supplier_id',
        'total_purchased_order',
        'total_profit',
        'total_price',
        'isReturn',
        'isRemove',
        'total_orders',
        'remarks',
        'name_of_a_driver' ,
        'plate_number',
        
        'doc_no',
        'entry_date',
        'po_no',
        'po_date',
        'location_id',
        'reference',
        'trade_discount',
        'terms_discount',
       
    ];
    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'purchase_order_number_id', 'purchase_order_number');
    }
    public function pendingproducts()
    {
        return $this->hasMany(PendingProduct::class, 'purchase_order_number_id', 'purchase_order_number');
    }
    public function returned()
    {
        return $this->hasMany(Returned::class, 'purchase_order_number_id', 'purchase_order_number');
    }
    public function pendingreturnedproducts()
    {
        return $this->hasMany(PendingReturnedProduct::class, 'purchase_order_number_id', 'purchase_order_number');
    }
    public function totalucs()
    {
        return $this->hasMany(UCS::class, 'purchase_order_number_id', 'purchase_order_number');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

}
