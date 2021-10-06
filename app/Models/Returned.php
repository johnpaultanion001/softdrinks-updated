<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Returned extends Model
{
    use HasFactory;
    public $table = 'returneds';

    protected $fillable = [
        'user_id',
        'purchase_order_number_id',
        'total_case_return',
        'total_deposit',
        'total_orders_returned',
        'isRemove',
        
        
    ];

    public function purchase_order()
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_number_id', 'purchase_order_number');
    }
    public function pendingreturned()
    {
        return $this->hasMany(PendingReturnedProduct::class, 'return_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
