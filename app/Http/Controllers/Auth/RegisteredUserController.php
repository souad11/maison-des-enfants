<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Tutor;
use App\Models\User;
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
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
        
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'login' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'langue' => ['required', 'string', 'max:2'],
            'address' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:255'],
        ]);
    
        $user = User::create([
            
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'login' => $request->login,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'langue' => $request->langue,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
        ]);
    

         // Créer un profil tuteur
         Tutor::create([
            'user_id' => $user->id,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'phone_number' => $request->phone_number,
        ]);
        event(new Registered($user));
    
        Auth::login($user);
    
        // return redirect()->route('home');

        $user->sendEmailVerificationNotification();
        
        return redirect()->route('verification.notice'); 



    }
    
}
