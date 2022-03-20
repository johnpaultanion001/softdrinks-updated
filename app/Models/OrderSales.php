<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSales extends Model
{
    use HasFactory;
    public $table = 'order_sales';

    protected $fillable = [
        'order_number_id',
        'total_profit',
        'total_sales',
        'total_cost',
        'customer_id',
        'total_qty',
        'subtotal',
        'total',
    ];

    
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    
}
