<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusReturn extends Model
{
    use HasFactory;
    public $table = 'status_returns';

    protected $fillable = [
        'code',
        'title',
        'user_id',
        'isRemove',
        
    ];
    public function pendingreturnedproducts()
    {
        return $this->hasMany(PendingReturnedProduct::class, 'status_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
