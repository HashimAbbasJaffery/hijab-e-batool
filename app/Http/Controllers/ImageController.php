<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Models\Image;

class ImageController extends Controller
{
    public function index($slug) {
        
        $product = Product::where("slug", $slug)->withCount("images")->first();
        $products = Product::where("slug", $slug)->first();
        $images = $products->images;
        $productId = Product::select("id")->where("slug", $slug)->first();
        return view("products.imageUpload")->with(compact("productId", "images"));
    }
    public function create($id) {
        $product = Product::where("id", $id)->withCount("images")->first();
        if($product->images_count > 4) {
            return Response::json(["error" => "Limit of 5 images reached! Please delete previous old one to upload more"]);
        } else {
            $file = request()->file("file");
            $time = time();
            $filename = $time . $file->getClientOriginalName();
            $file->move("uploads/", $filename);

            Image::create([
                "filename" => $filename,
                "product_id" => $id,
                "sequence" => 1
            ]);

            return 'lol';
        }
    }
    public function delete() {
        $deleted = DB::table("images")->whereIn("id", request()->get("key"))->delete();
        return 1;
    }
}
