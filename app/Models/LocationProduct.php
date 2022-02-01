<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'location_id',
        'stock',
    ];
    public function product()
    {
        return $this->belongsTo(SalesInventory::class, 'product_id');
    }
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
