<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmptyBottlesInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'qty',
    ];

    public function product()
    {
        return $this->belongsTo(SalesInventory::class, 'product_id');
    }

    public function sales_returns()
    {
        return $this->hasMany(SalesReturn::class, 'product_id' , 'product_id')->latest();
    }

    public function recieve_returns()
    {
        return $this->hasMany(RecieveReturn::class, 'product_id' , 'product_id')->latest();
    }

    
}
