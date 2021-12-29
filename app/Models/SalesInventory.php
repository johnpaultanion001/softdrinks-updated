<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'receiving_good_id',

        'product_code',
        'category_id',
        'description',

        'qty',
        'sold',
        'orders',
        'size_id',
        'expiration',

        'unit_cost',
        'price',
        'total_cost',
        'regular_discount',
        'hauling_discount',
    
        'product_remarks',
        'supplier_id',

        'isComplete',
        'isRemove',
        
       
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function receiving_good()
    {
       return $this->belongsTo(ReceivingGood::class, 'receiving_good_id');
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
    public function stock_histories()
    {
        return $this->hasMany(ReceivingProduct::class, 'product_id', 'id');
    }
    public function sales_histories()
    {
        return $this->hasMany(Sales::class, 'product_id', 'id');
    }
    public function location_products()
    {
        return $this->hasMany(LocationProduct::class, 'product_id', 'id');
    }
    public function location_products_stock()
    {
        return $this->hasMany(LocationProduct::class, 'product_id', 'id')->where('location_id', 2)->sum('stock');
    }


}
