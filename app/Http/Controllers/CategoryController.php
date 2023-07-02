<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::paginate(7);
        return view("categories.index", compact("categories"));
    }
    public function categories() {
        $q = request()->get("q");
        $categories = Category::where("name", "like", "%" . $q . "%")->paginate(7);
        return $categories;
    }
    public function changeStatus(Category $category) {
        $category["status"] = ! $category["status"];
        $category->save();
        return 1;
    }
    public function delete(Category $category) {
        $category->delete();
        return 1;
    }
    public function search($keyword = null) {
        $categories = Category::where("name", "like", "%" . $keyword . "%")
                            ->paginate(7);
        return $categories;
    }
    public function create() {
        return view("categories.create");
    }
    public function store() {
        $validation = Validator::make(request()->all(), [
            "name" => "required",
            "slug" => "required|unique:categories",
            "status" => "required"
        ]);
        if($validation->fails()) {
            return $validation->getMessageBag()->toArray();
        }
        Category::create([
            "name" => request()->get("name"),
            "slug" => request()->get("slug"),
            "status" => request()->get("status")
        ]);
        return 1;
    }
    public function update(Category $category) {
        return view("categories.update", compact("category"));
    }
    public function edit(Category $category) {
        $validation = Validator::make(request()->all(), [
            "name" => "required",
            "slug" => "required|unique:categories,slug," . $category->id,
            "status" => "required"
        ]);
        if($validation->fails()) {
            return $validation->getMessageBag()->toArray();
        }
        $category = $category->update([
            "name" => request()->get("name"),
            "status" => request()->get("status"),
            "slug" => request()->get("slug")
        ]);
        return 1;
        // return request()->get("status");
    }

}
