<?php

namespace App\Models;

use App\Enums\PurchaseStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'datetime',
        'status',
        'file',
        'total',
    ];

    public function details()
    {
        return $this->hasMany(PurchaseDetail::class);
    }

    protected function casts(): array
    {
        return [
            'status' => PurchaseStatus::class,
            'datetime' => 'datetime',
        ];
    }
}
