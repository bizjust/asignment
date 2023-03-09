<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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
    public function store(Request $request): RedirectResponse
    {
        $is_username = User::where('username', $request->email)->count();
        $phone = substr($request->email, -10);
        $is_phone = User::where('phone', $phone)->count();
        if($is_phone)
        {
            $field = 'phone';
            $val = $phone;
        } else if($is_username) {
            $field = 'username';
            $val = $request->email;
        } else {
            $field = 'email';
            $val = $request->email;
        }

        if (Auth::attempt([$field => $val, 'password' => $request->password])) {
            // The user is active, not suspended, and exists.
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        /* $request->authenticate();

        $request->session()->regenerate(); */

        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
