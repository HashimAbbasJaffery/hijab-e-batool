<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function changeStatus(Order $order) {
        if(!request()->get("status")) {
            return redirect()->back()->with("message", "Please select status");
        }
        $order["status"] = request()->get("status");
        $order->save();
        return redirect()->back();
    }
    public function index(Request $request) {


        $filters = [
            "q" => request()->get("q"),
            "status" => request()->get("status"),
            "orderNumber" => request()->get("orderNumber")
        ];
        $orders = Order::with(["products", "user"])->filter($filters)->paginate(15);
        
        return view("orders.index")->with(compact("orders", "filters"));
    }

    public function view(Order $order) {
        
        return view("orders.view")->with(compact("order"));

    }
}
