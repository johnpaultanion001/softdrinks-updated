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
        'prepared_by',
        'remarks',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'prepared_by');
    }
    public function transfers()
    {
        return $this->hasMany(PendingTransfer::class, 'lt_id' , 'id')->latest();
    }
}
