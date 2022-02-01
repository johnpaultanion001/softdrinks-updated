<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingTransfer extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'location_from',
        'location_to',
        'qty',
        'lt_id',
        'is_complete',
    ];

    public function product()
    {
        return $this->belongsTo(SalesInventory::class, 'product_id');
    }
    public function locationfrom()
    {
        return $this->belongsTo(Location::class, 'location_from', 'id');
    }
    public function locationto()
    {
        return $this->belongsTo(Location::class, 'location_to', 'id');
    }
    
}
