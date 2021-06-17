<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'items',
        'table',
    ];

    public function items()
    {
        return $this->belongsToMany(MenuItem::class, 'order_item', 'order_id', 'item_id')
            ->withPivot(['amount', 'notes']);
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

    public function getTurnoverAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->pivot->amount * $item->price;
        });
    }

    public function getTaxAttribute()
    {
        return $this->turnover * 0.21;
    }

    public function getProfitAttribute()
    {
        return $this->turnover / 1.21;
    }
}
