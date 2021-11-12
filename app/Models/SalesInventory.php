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

        'stock',
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
        'location_id',
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

}
