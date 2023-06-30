<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Product extends Model
{
    // protected $with = ["categories"];
    use HasFactory;
    public function categories() {
        return $this->belongsToMany(Category::class, "category_product");
    }

    public function images() {
        return $this->hasMany(Image::class);
    }
    protected $guarded = ["id", "created_at", "updated_at"];
}
