<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\Backend\NotificationService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('frontend.pages.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', "min:4"],
            "securityCodeInput" => ['required', 'confirmed' , 'numeric'],
        ]);

        $user = User::create([
            'name' => $request->name." ".$request->last_name ,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => "user",
        ]);

        event(new Registered($user));

        NotificationService::sendNotificationToAdmins("RegisterNotify","New Register User");

        Auth::login($user);

        //Event Confirm Email

        return redirect(RouteServiceProvider::HOME);
    }
}
