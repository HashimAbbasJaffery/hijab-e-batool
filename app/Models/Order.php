<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Purchase;
use App\Models\Product;


class Order extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function scopeFilter($query, array $filters = []) {

        if(!$filters) {
            return $query;
        }

        $query->when($filters["q"], function() use ($query, $filters) {
            $query->whereExists(function ($query) use($filters) {
                $query->select("*")
                    ->from("users")
                    ->whereRaw("users.id = orders.user_id")
                    ->whereRaw("name LIKE '%" . $filters["q"] . "%'");
            });
        });

        $query->when($filters["status"], function() use($query, $filters) {
            $query->where("status", $filters["status"]);
        });

        $query->when($filters["orderNumber"], function() use($query, $filters) {
            $query->where("order_number", $filters["orderNumber"]);
        });

        return $query;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class)->withPivot("quantity");
    }
}
