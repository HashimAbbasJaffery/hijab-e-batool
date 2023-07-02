<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ["id", "created_at", "updated_at"];

    use HasFactory;
    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
