<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesReturn extends Model
{
    use HasFactory;

    public $table = 'sales_returns';

    protected $fillable = [
        'salesinvoice_id',
        'product_id',
        'return_qty',
        'unit_price',
        'amount',
        'status_id',
        'remarks',
        'type_of_return',

        
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
