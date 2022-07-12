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
        return $this->hasMany(SalesReturn::class, 'product_id' , 'product_id')->where('type_of_return', 'EMPTY')->where('isComplete', true)->latest();
    }

    public function recieve_returns()
    {
        return $this->hasMany(RecieveReturn::class, 'product_id' , 'product_id')->where('isComplete', true)->latest();
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class, 'product_id' , 'product_id')->where('isComplete', true)->latest();
    }

    public function empties_qty()
    {
        $sales = $this->hasMany(SalesReturn::class, 'product_id' , 'product_id')->where('type_of_return', 'EMPTY')->where('isComplete', true)->latest()->where('status_id', 1)->sum('return_qty');
        $receive = $this->hasMany(RecieveReturn::class, 'product_id' , 'product_id')->where('isComplete', true)->latest()->where('status_id', 1)->sum('return_qty');
        $deposit = $this->hasMany(Deposit::class, 'product_id' , 'product_id')->where('isComplete', true)->latest()->where('status_id', 1)->sum('qty');
        $total = $sales - $receive - $deposit;

        return $total ?? '0';
    }

    public function shells_qty()
    {
        $sales = $this->hasMany(SalesReturn::class, 'product_id' , 'product_id')->where('type_of_return', 'EMPTY')->where('isComplete', true)->latest()->where('status_id', 2)->sum('return_qty');
        $receive = $this->hasMany(RecieveReturn::class, 'product_id' , 'product_id')->where('isComplete', true)->latest()->where('status_id', 2)->sum('return_qty');
        $deposit = $this->hasMany(Deposit::class, 'product_id' , 'product_id')->where('isComplete', true)->latest()->where('status_id', 2)->sum('qty');
        $total = $sales - $receive - $deposit;

        return $total ?? '0';
    }
    
    public function bottles_qty()
    {
        $sales = $this->hasMany(SalesReturn::class, 'product_id' , 'product_id')->where('type_of_return', 'EMPTY')->where('isComplete', true)->latest()->where('status_id', 3)->sum('return_qty');
        $receive = $this->hasMany(RecieveReturn::class, 'product_id' , 'product_id')->where('isComplete', true)->latest()->where('status_id', 3)->sum('return_qty');
        $deposit = $this->hasMany(Deposit::class, 'product_id' , 'product_id')->where('isComplete', true)->latest()->where('status_id', 3)->sum('qty');
        $total = $sales - $receive - $deposit;

        return $total ?? '0';
    }
}
