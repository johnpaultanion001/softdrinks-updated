<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    public $table = 'sales';

    protected $fillable = [
        'salesinvoice_id',
        'order_number',
        'product_id',
        'product_price',
        'purchase_qty',
        'profit',
        'total',
        'status',
        'customer_id',
        'pricetype_id',
        'discounted',
        'total_cost',
        'total_amount_receipt',
        'user_id',
    ];
    public function salesinvoice()
    {
       return $this->belongsTo(SalesInvoice::class, 'salesinvoice_id', 'salesinvoice_id');
    }
    public function product()
    {
        return $this->belongsTo(SalesInventory::class, 'product_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function pricetype()
    {
        return $this->belongsTo(PriceType::class, 'pricetype_id');
    }
}
