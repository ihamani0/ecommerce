<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Mockery\Exception;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        try {



            $validated = $request->validate([
                'current_password' => ['required'],
                'new_password' => ['required', Password::defaults(), 'confirmed'],
            ]);




            //Hash::check( $OldPasswordFromInput , $userPasswordFromDataBase)
            if ( !  Hash::check( $request->current_password , auth()->user()->password)  ){
                return back()->with(["error"=> "The old password doesn't match"]);
            }

            $request->user()->update([
                'password' => Hash::make($validated['new_password']),
            ]);

            return back()->with(["success"=> "The Password Has been update Successfully"]);

        }catch (Exception $exception){
            return back()->with(["error"=> $exception->getMessage()]);
        }
    }
}
