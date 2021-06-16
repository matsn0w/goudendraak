<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number',
        'category_id',
        'price',
        'description',
    ];

    public function category()
    {
        return $this->hasOne(MenuCategory::class, 'id', 'category_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
