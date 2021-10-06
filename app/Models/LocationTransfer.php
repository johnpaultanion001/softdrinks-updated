<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationTransfer extends Model
{
    use HasFactory;

    public $table = 'location_transfers';

    protected $fillable = [
        'entry_date',
        'reference',
        'reference_date',
        'location_from',
        'location_to',
        'transfer_count',
        'prepared_by',
        'remarks',
        'isRemove',
    ];


    public function locationfrom()
    {
        return $this->belongsTo(Location::class, 'location_from');
    }

    public function locationto()
    {
        return $this->belongsTo(Location::class, 'location_to');
    }
}
