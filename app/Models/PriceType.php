<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceType extends Model
{
    use HasFactory;
    public $table = 'price_types';

    protected $fillable = [
        'price_type',
        'discount',
        'isRemove',
    ];
}
