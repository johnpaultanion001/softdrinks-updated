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
        'inventory_id',
        'user_id',
        'purchase_qty',
        'profit',
        'total',
        'isRemove',
        'status',
        'customer_id',
        'pricetype_id',
        'discounted',
        'total_cost',
        'total_amount_receipt',
    ];
    public function salesinvoice()
    {
       return $this->belongsTo(SalesInvoice::class, 'salesinvoice_id', 'salesinvoice_id');
    }
    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function pricetype()
    {
        return $this->belongsTo(PriceType::class, 'pricetype_id');
    }

    public function ordersales()
    {
        return $this->belongsTo(OrderSales::class, 'order_number' , 'order_number_id' );
    }
}
