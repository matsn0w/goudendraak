<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'items',
    ];

    public function items()
    {
        return $this->belongsToMany(MenuItem::class, 'order_item', 'order_id', 'item_id')
            ->withPivot('amount');
    }

    public function scopeDate($query, $start = null, $end = null)
    {
        if ($start) {
            $query = $query->whereDate('created_at', '>=', $start);
        }

        if ($end) {
            $query = $query->whereDate('created_at', '<=', $end);
        }

        return $query;
    }
}