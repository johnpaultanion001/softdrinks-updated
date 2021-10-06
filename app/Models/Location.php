<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public $table = 'locations';

    protected $fillable = [
        'location_name',
        'remarks',
        'isRemove',
    ];

    public function purchaseorders()
    {
        return $this->hasMany(PurchaseOrder::class, 'location', 'id');
    }
}

