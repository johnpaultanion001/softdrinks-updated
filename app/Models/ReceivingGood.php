<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivingGood extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'supplier_id',
        'location_id',

        'doc_no',
        'entry_date',
        'po_no',
        'po_date',

        'plate_number',
        'name_of_a_driver',
        'trade_discount',
        'terms_discount',

        'remarks',
        'reference',

        'total_orders',
        'over_all_cost',
        'cash',
        'isRemove',
    ];
    public function products()
    {
        return $this->hasMany(ReceivingProduct::class, 'receiving_good_id', 'id');
    }
    public function returns()
    {
        return $this->hasMany(RecieveReturn::class, 'receiving_good_id', 'id');
    }
  
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
