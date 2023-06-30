<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 



class ProductController extends Controller
{
    public function create() {
        $categories = Category::all();
        return view("products.create", compact("categories"));
    }
    public function store() {
        $categories = request()->get("categories");

        $validation = Validator::make(request()->all(), [
            "name" => "required",
            "slug" => "required",
            "price" => "required|numeric",
            "wholeSalePrice" => "required|numeric",
            "description" => "required|max:255",
            "product_img" => "required",
            "quantity" => "required|numeric",
            "status" => "required|boolean",
            "category" => "required"
        ]);
        if($validation->fails()) {
            return $validation->getMessageBag()->toArray();
        }
        
        $file = request()->file("product_img");
        $filename = time() . $file->getClientOriginalName();
        $file->move("uploads/", $filename);
        $product = Product::create([
            "name" => request()->get("name"),
            "slug" => request()->get("slug"),
            "price" => request()->get("price"),
            "wholeSalePrice" => request()->get("wholeSalePrice"),
            "description" => request()->get("description"),
            "picture" => $filename,
            "profit" => "0",
            "soldQuantity" => 0,
            "quantity" => request()->get("quantity"),
            "status" => request()->get("status"),
        ]);
        $product->categories()->attach(json_decode(request()->get("categories")));
        return 1;
    }
    public function index() {
        $products = Product::orderBy("created_at", "desc")->paginate(7);
        return view("products.index", compact("products"));
    }
    public function show() {
        $page = request()->get("page");
        $keyword = request()->get("q");
        $products = Product::
                    where("name", "like", "%" . $keyword . "%")
                    ->paginate(7);
        return $products;
    }
    public function status(Product $product) {
        $product["status"] = !$product["status"];
        $product->save();
        return $product->status;
    }
    public function edit(Product $product) {
        $product->categories()->attach(json_decode(request()->get("categories")));
        $categories = Category::all();
        return view("products.update", compact(["product", "categories"]));
    }
    public function update(Product $product) {
        $categories = request()->get("categories");
        $validation = Validator::make(request()->all(), [
            "name" => "required",
            "slug" => "required",
            "price" => "required|numeric",
            "wholeSalePrice" => "required|numeric",
            "description" => "required",
            "product_img" => "required|mimes:jpg,png,jpeg",
            "quantity" => "required|numeric",
            "status" => "required|boolean",
            "category" => "required"
        ]);
        if($validation->fails()) {
            return $validation->getMessageBag()->toArray();
        }

        // Delete the existing File
        $filepath = public_path("/uploads/" . $product->picture);
        File::delete($filepath);

        $file = request()->file("product_img");
        $filename = time() . $file->getClientOriginalName();
        $file->move("uploads/", $filename);
        $updatedProduct = Product::where("slug", $product->slug)->update([
            "name" => request()->get("name"),
            "slug" => request()->get("slug"),
            "price" => request()->get("price"),
            "wholeSalePrice" => request()->get("wholeSalePrice"),
            "description" => request()->get("description"),
            "picture" => $filename,
            "profit" => "0",
            "soldQuantity" => 0,
            "quantity" => request()->get("quantity"),
            "status" => request()->get("status"),
        ]);
        
        $product->categories()->sync(json_decode(request()->get("categories")));
        return 1;
    }
    public function search($keyword = null) {
        $products = Product::where("name", "like", "%" . $keyword . "%")
                            ->orWhere("description", "like", "%" . $keyword . "%")
                            ->paginate(7);
        return $products;
    }
    public function delete(Product $product) {
        $filepath = public_path("/uploads/" . $product->picture);
        $product->delete();
        File::delete($filepath);
        $products = Product::paginate(7);
        return $products;
    }
}
