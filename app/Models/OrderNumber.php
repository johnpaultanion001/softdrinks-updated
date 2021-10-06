<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderNumber extends Model
{
    use HasFactory;
    public $table = 'order_numbers';

    protected $fillable = [
        'order_number',
        'salesinvoice_id',
    ];
}
