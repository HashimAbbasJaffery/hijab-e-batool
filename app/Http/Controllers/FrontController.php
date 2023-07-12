<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class FrontController extends Controller
{
    public function index() {
        
        $products = Product::where("status", 1)->limit(8)->get();
        
        $productIds = $products->map(function($product) {
            return $product->only("id");
        });

        
        $shopProducts = Product::whereNotIn("id", $productIds->toArray())
                                ->where("status", 1)
                                ->limit(12)
                                ->get();

        $categories = Category::where("status", "1")->limit(16)->get();
        $i = 0;
        $categoryCollection = [[], []];

        foreach($categories as $category) {
            if($i < 8) {
                array_push($categoryCollection[0], $category);
            } else {
                array_push($categoryCollection[1], $category);
            }
            $i++;
        }


        return view("front.index")->with(compact("categoryCollection", "products", "shopProducts"));
    }
}
