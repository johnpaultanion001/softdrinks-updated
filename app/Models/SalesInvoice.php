<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesInvoice extends Model
{
    use HasFactory;
    public $table = 'sales_invoices';

    protected $fillable = [
        'salesinvoice_id',
        'doc_no',
        'entry_date',
        'remarks',
        'customer_id',
        'deliver_id',
        'subtotal',
        'total_discount',
        'total_amount',
        'total_return',
        'prev_bal',
        'total_inv_amt',
        'cash',
        'new_bal',
        'user_id',
        'isVoid',
        'change',
       
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function deliver()
    {
        return $this->belongsTo(AssignDeliver::class, 'deliver_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function receipt_product()
    {
        return $this->hasMany(Sales::class, 'salesinvoice_id' , 'salesinvoice_id')->latest();
    }
    public function receipt_return()
    {
        return $this->hasMany(SalesReturn::class, 'salesinvoice_id' , 'salesinvoice_id')->latest();
    }
    public function sales()
    {
        return $this->hasMany(Sales::class, 'salesinvoice_id' , 'salesinvoice_id')->latest();
    }
    public function returns()
    {
        return $this->hasMany(SalesReturn::class, 'salesinvoice_id' , 'salesinvoice_id')->latest();
    }
    public function pallets()
    {
        return $this->hasMany(SalesPallet::class, 'salesinvoice_id', 'salesinvoice_id')->where('type', 'BUY');
    }
    public function pallets_returns()
    {
        return $this->hasMany(SalesPallet::class, 'salesinvoice_id', 'salesinvoice_id')->where('type', 'RETURN');
    }

    
}
