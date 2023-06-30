<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index() {
        $last30Days = \Carbon\Carbon::today()->subDays(30);
        $lastYear = \Carbon\Carbon::today()->subYears(1);
        $leastYear = \Carbon\Carbon::today()->subYears(2);

        // Total Income of last 30 days

        $delivered30Days = Order::where([
            ["created_at", ">", $last30Days],
            ["status", "Delivered"]
        ])->sum('grand_total');

        // Overall Income

        $ordersSum = Order::get()->sum("grand_total");

        // New Orders

        $newOrders = Order::where("status", "pending")->count();
        $ordersByMonth = [];
        $ordersByYear = [];
        $categoryQty = [];

        for($i = 1; $i <= 12; $i++) {

            // Pushing the count of orders of current month orders and current year

            array_push($ordersByMonth, Order::whereMonth("created_at", "=", $i)
                                            ->where("created_at", ">", $lastYear)
                                            ->where("status", "Delivered")
                                            ->count());

            // Pushing the count of orders of current month orders and last year
            
            array_push($ordersByYear, Order::whereMonth("created_at", "=", $i)
                                            ->where("created_at", ">", $leastYear)
                                            ->where("created_at", "<", $lastYear)
                                            ->where("status", "Delivered")
                                            ->count());
        }

        $categories = Category::withCount("products")
                        ->orderBy("products_count", "desc")
                        ->take(5)
                        ->get();
        
        $ordersByMonth = json_encode($ordersByMonth);
        $ordersByYear = json_encode($ordersByYear);

        $usersQty = User::get()->count();
        return view("index", compact("categories", "usersQty", "delivered30Days", "ordersSum", "newOrders", "ordersByMonth", "ordersByYear"));
    }
}
