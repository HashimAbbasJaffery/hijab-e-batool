<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\File; 

class ProfileController extends Controller
{
    public function index() {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view("profile.index")->with(compact('user'));
    }
    public function changeDetails() {
        $name = request()->get("name");
        $email = request()->get("email");;

        $validate = Validator::make(request()->all(), [
            "name" => "required",
            "email" => "email|unique:users,email," . auth()->user()->id,
        ]);

        if($validate->fails()) {
            return response()->json(["errors", $validate->errors()]);
        }

        $user = User::find(auth()->user()->id);
            
        // Storing in the file
        if(request()->hasFile("picture")) {
            $file = request()->file("picture");
            $fileName = time() . $file->getClientOriginalName();
            if($user->picture) {

                $path = public_path() . "/uploads/" . $user->picture;
                File::delete($path);

                $file->move(public_path() . "/uploads/", $fileName);
            
            } else {
                // Create the picture

                $file->move(public_path() . "/uploads/", $fileName);
            }

            $user->update([
                "picture" => $fileName,
                "name" => $name,
                "email" => $email
            ]);

            return 1;
        }
        // Updating the database

        $user->update([
            "name" => $name,
            "email" => $email
        ]);
        return 1;

    }
    public function changePassword() {
        
        $validate = Validator::make(request()->all(), [
            "old_password" => "required",
            "password" => "required|confirmed",
            "password_confirmation" => "required"
        ]);

        if($validate->fails()) {
            return response()->json(["errors" => $validate->errors()]);
        }

        
        if(Hash::check(request()->get("password"), auth()->user()->password)) {
            return "New Password must different from old password";
        }


        if(Hash::check(request()->get('old_password'), auth()->user()->password)) {
            $user = User::findOrFail(auth()->user()->id);

            $user->fill([
                "password" => Hash::make(request()->get("password"))
            ])->save();

            return 1;
        }
        
        return "Incorrect current password";
        
    }
}
