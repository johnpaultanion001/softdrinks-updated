<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $table = 'categories';

    protected $fillable = [
        'name',
        'note',
        'isRemove',
    ];

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'category_id', 'id');
    }
    public function pendingproducts()
    {
        return $this->hasMany(PendingProduct::class, 'category_id', 'id');
    }
}
