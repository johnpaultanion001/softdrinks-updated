<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;
    protected $fillable = [
        'salesinvoice_id',
        'product_id',
        'qty',
        'unit_price',
        'amount',
        'status_id',
        'remarks',
        'isComplete',
    ];
    
    public function salesinvoice()
    {
       return $this->belongsTo(SalesInvoice::class, 'salesinvoice_id', 'salesinvoice_id');
    }
    public function product()
    {
        return $this->belongsTo(SalesInventory::class, 'product_id');
    }
    public function status()
    {
        return $this->belongsTo(StatusReturn::class, 'status_id');
    }
    public function empty_inventory()
    {
        return $this->belongsTo(EmptyBottlesInventory::class, 'product_id', 'product_id');
    }
}
