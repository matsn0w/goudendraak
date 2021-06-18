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
        'number_addition',
        'category_id',
        'price',
        'description',
        'spiciness',
    ];

    public function category()
    {
        return $this->hasOne(MenuCategory::class, 'id', 'category_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function allergens()
    {
        return $this->belongsToMany(Allergen::class, 'menuitem_allergen', 'item_id', 'allergen_id');
    }
}
