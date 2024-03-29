<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    public $table = 'sizes';
    protected $fillable = [
        'title',
        'size',
        'ucs',
        'status',
        'category_id',
        'isRemove',
        'note',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
