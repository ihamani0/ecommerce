<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Frontend\LandingPageInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileUserController extends Controller
{

    public function __construct(public LandingPageInterface $lPage)
    {}

    public function index(){
        return view("frontend.pages.account" , [
            'Categories' => $this->lPage->getAllCategories(),
        ]);
    }
    /**
     * Display the user's profile form.
     */

    /*public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }*/

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        try {
            //make update
            $test = $request->user()->fill($request->validated());

            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }

            event(new Registered($request->user()));
            $request->user()->save();

            return redirect()->intended(route('user.account'))->with(["success"=> "The Profile Has been update Successfully"]);
        }catch (\Exception $exception){
            dd($exception->getMessage());
        }

    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        if ( !  Hash::check( $request->password , auth()->user()->password)  ){
            return back()->with(["error"=> "The old password doesn't match"]);
        }

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
