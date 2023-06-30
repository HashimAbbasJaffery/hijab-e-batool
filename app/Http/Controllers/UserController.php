<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $filters = [
            "q" => request()->get("q"),
            "role" => request()->get("role")
        ];
        $users = User::filter($filters)->simplePaginate(15);
        return view("users.index")->with(compact("users"));
    }
    public function changeRole(User $user) {
        $newRole = request()->get("role");
        $user["role"] = $newRole;
        $user->saveOrFail();
        return 1;
    }
}
