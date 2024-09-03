<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
public function store(LoginRequest $request)
{
    // Authentifie l'utilisateur
    $request->authenticate();

    // Régénère la session pour éviter les attaques de fixation de session
    $request->session()->regenerate();

    // Récupère l'utilisateur authentifié
    $user = Auth::user();

    // Crée un token d'accès personnel pour l'utilisateur et le stocke en base de données
    $user->createToken('auth_token')->plainTextToken;

    // Redirige l'utilisateur vers le tableau de bord
    return redirect()->route('dashboard');


    // $request->authenticate();
    //     $request->session()->regenerate();
    
    //     $user = Auth::user();
    //     $token = $user->createToken('auth_token')->plainTextToken;
    
    //     return response()->json([
    //         'user' => $user,
    //         'token' => $token,
    //     ]);
}

    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/home');
    }
}
