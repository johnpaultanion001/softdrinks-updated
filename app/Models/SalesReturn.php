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
        'pricetype_id',
        'discounted',
        'unit_price',
        'amount',
        'status_id',
        'remarks',

        
    ];
    public function salesinvoice()
    {
       return $this->belongsTo(SalesInvoice::class, 'salesinvoice_id', 'salesinvoice_id');
    }
    public function product()
    {
        return $this->belongsTo(SalesInventory::class, 'product_id');
    }

    public function pricetype()
    {
        return $this->belongsTo(PriceType::class, 'pricetype_id');
    }
    public function status()
    {
        return $this->belongsTo(StatusReturn::class, 'status_id');
    }
  
}
