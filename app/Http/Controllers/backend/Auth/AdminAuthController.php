<?php

namespace App\Http\Controllers\backend\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    public function index(){

        return view("backend.admin.pages.dashboard");
    }

    public function showLogin()
    {
        return view("backend.admin.pages.auth.login");
    }

    public function LoginStore(Request $request)
    {
        $this->authnticate($request);

        $request->session()->regenerate();

        return redirect()->route("admin.dashboard");
    }

    public function authnticate(Request $request){

        //for validation input
        $this->validateForm($request);

        $cred = $request->only(["email","password"]);



        $this->ensureIsNotRateLimited($request);

        if(! ( Auth::guard("admin")->attempt($cred) ) )
        {

            RateLimiter::hit($this->throttleKey($request));
            return redirect()->back()->withErrors("Credentiales invalid login");
        }

        RateLimiter::clear($this->throttleKey($request));

    }

    public function validateForm(Request $request){

        $request->validate([
            "email"=> "required | email",
            "password"=> "required | min:4"
        ]);

    }

    public function logout(Request $request): RedirectResponse{
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }




    //not my code but i will undersan it
    public function ensureIsNotRateLimited(Request $request): void{
        if (! RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            return;
        }

        //event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }



    public function throttleKey(Request $request): string{
        return Str::transliterate(Str::lower($request->email).'|'.$this->ip($request));
    }

    public function ip(Request $request){
        $ipAddress = $request->server('REMOTE_ADDR');

        return $ipAddress;
    }




}
