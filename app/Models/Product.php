<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'is_active',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_category')->withTimestamps();
    }
}
