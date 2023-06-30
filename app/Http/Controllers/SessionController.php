<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Mockery\Generator\StringManipulation\Pass\Pass;
use Illuminate\Support\Str;

class SessionController extends Controller
{
    public function login() {
        return view("authentication.login");
    }
    public function reset_password_view() {
        return view("authentication.resetPassword");
    }
    public function updateCredentials(Request $request) {

        // Validation for changing the password
        $request->validate([
            "token" => "required",
            "email" => "required|email",
            "password" => "required|confirmed"
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function(User $user, string $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );
        return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors('email', __($status));
    }
    public function sendLink(Request $request) {
        $request->validate(["email" => "required|email"]);

        $status = Password::sendResetLink(
            $request->only("email")
        );

        return $status === Password::RESET_LINK_SENT 
                ? back()->with(["status" => __($status)])
                : back()->withErrors(['email' => __($status)]);
    }

    public function authenticate(Request $request) {
        $flag = 0;
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $is_remember = request()->get("remember");
        try {
            $is_authenticated = Auth::attempt($credentials, $is_remember);
            $request->session()->regenerate();
            if($is_authenticated) {
                $flag = 1;
                
            }
        } catch(\Throwable $e) {
            return $e;
        }
        return $flag;
    }
    public function destroy() {
        Auth::logout();
        return redirect()->back();
    }
}
