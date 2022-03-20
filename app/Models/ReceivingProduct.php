<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivingProduct extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'receiving_good_id',
        'product_id',

        'product_code',
        'category_id',
        'description',

        'qty',
        'size_id',
        'expiration',

        'unit_cost',
        'regular_discount',
        'hauling_discount',
        'price',
        'total_cost',
        
    
        'product_remarks',
        'location_id',
        'supplier_id',
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
    public function product()
    {
        return $this->belongsTo(ReceivingProduct::class,'product_id');
    }
}
