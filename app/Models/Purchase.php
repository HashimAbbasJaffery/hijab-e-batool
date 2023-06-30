<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Purchase extends Model
{
    protected $with = "product";
    use HasFactory;
    public function product() {
        return $this->hasOne(Product::class, "id");
    }
}
