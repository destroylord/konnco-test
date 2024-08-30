<?php

namespace App\Models;

use App\Enums\ItemStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name', 'category_id', 'price', 'stock', 'image', 'status'
    ];

    protected $casts = [
        'status' => ItemStatus::class
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
