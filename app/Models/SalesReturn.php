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
        'inventory_id',
        'return_qty',
        'pricetype_id',
        'unit_price',
        'amount',
        'isRemove',

        
    ];
    public function salesinvoice()
    {
       return $this->belongsTo(SalesInvoice::class, 'salesinvoice_id', 'salesinvoice_id');
    }
    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }

    public function pricetype()
    {
        return $this->belongsTo(PriceType::class, 'pricetype_id');
    }
  
}
