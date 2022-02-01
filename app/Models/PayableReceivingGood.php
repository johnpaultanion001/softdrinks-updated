<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayableReceivingGood extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'receiving_good_id',
        'payable_amount',

    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function receiving_good()
    {
       return $this->belongsTo(ReceivingGood::class, 'receiving_good_id');
    }
}
