<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GoogleAuthController extends Controller
{
    // Redirect the user to Google's OAuth page
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle the callback from Google
    public function callbackGoogle()
    {
        try {
            // Obtain the user information from Google
            $googleUser = Socialite::driver('google')->user();

            // Check if the user already exists in your database
            $user = User::where('google_id', $googleUser->getId())->orWhere('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Create a new user if they don't exist
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make(uniqid()) // Generate a random password for the user
                ]);
            }

            // Log the user in
            Auth::login($user);

            // Redirect the user to the intended page (dashboard in this case)
            return redirect()->intended('dashboard');

        } catch (\Throwable $th) {
            // Handle any errors during the process
            return redirect('/login')->withErrors(['msg' => 'Something went wrong: ' . $th->getMessage()]);
        }
    }
}
