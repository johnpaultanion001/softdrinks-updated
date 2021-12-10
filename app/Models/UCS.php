<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UCS extends Model
{
    use HasFactory;
    protected $fillable = [
        'receiving_good_id',
        'product_id',
        'ucs',
        'status_size',
        'qty',
        'isRemove',
        'isComplete',
        'ucs_size',
        'isHide',


    ];

    public function receiving_good()
    {
       return $this->belongsTo(ReceivingGood::class, 'receiving_good_id');
    }
    public function product()
    {
        return $this->belongsTo(ReceivingProduct::class,'product_id');
    }

}
