<?php

namespace App\Http\Controllers\backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;



class VendorAuthController extends Controller
{
    //Login
    public function showLogin(){
        return view("backend.vendor.pages.login");
    }

    public function Login(Request $request){





        $this->authntication($request);

        //dd($request->all());

        $request->session()->regenerate();

        return redirect()->route('vendor.dashboard');
    }

    public function authntication(Request $request){

            $request->validate([
                "email" => "required|email",
                "password"=> "required|string"
            ]);



            $this->ensureIsNotRateLimited($request);


            $credentials = $request->only("email","password");



            $user = $this->LoginAttemp($credentials);

            

            if (! $user) {

                RateLimiter::hit($this->throttleKey($request));
                // Login failed, redirect back with error message
                return back()->with('error', 'Invalid email or password');
            }

            RateLimiter::clear($this->throttleKey($request));



    }




    public function LoginAttemp(array $credentials){

        if(Auth::attempt($credentials)){
            return Auth::user();
        }
        return null;
    }




    //-----------------------------------------------------
    //Register

    public function showRegister(){
        return view("backend.vendor.pages.register");
    }

    public function Register(Request $request){

       try {
            $request->validate($this->rules());


            $user = $this->serviceRegister($request->all());

            if($user){
                Auth::login($user);
                return redirect()->route('vendor.dashboard');
            }else{
                return back()->withInput()->withErrors(['Error' => "Please Try again"]);
            }
       } catch (\Exception $e) {
                return back()->withInput()->withErrors(["Error"=> $e->getMessage()]);
       }

    }




    public function rules(){
    return [
        'firstname' => 'required|string',
        'lastname' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:4|string|confirmed',
    ];

    }


    public function serviceRegister(array $data){
        return User::create([
            'name' => $data['firstname']." ".$data['lastname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => "vendor"
        ]);
    }



    //logout

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('vendor.login');
    }









    //not my code but i will undersand it
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
