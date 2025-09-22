<?php

namespace App\Http\Controllers\Auth;

use App\Events\TwofaEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\TwofaToken;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

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
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        if(auth()->user()->has2fa) {
            return redirect()->route('request.2fa', ['user' => auth()->user()]);
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function create2fa(User $user)
    {
        $existingToken = TwofaToken::where("email", $user->email)->first();
        if(!$existingToken) {

            $code = '';
            for ($i = 0; $i < 6; $i++) {
                $code = $code.rand(0, 9);
            }

            TwofaToken::create([
                'email' => $user->email,
                'token' => Hash::make($code)
            ]);
            event(new TwofaEvent($user->email, $code));
        }

        return view('auth.twofa', ['user' => $user]);
    }

    public function check2fa(User $user, Request $request)
    {
        $val = $request->validate(['code' => ['required', 'max:6', 'min:6']]);
        $token = TwofaToken::where("email", $user->email)->first();
        if(Hash::check($val['code'], $token->token)) {
            TwofaToken::where('email', $token->email)->delete();
            return redirect()->to(RouteServiceProvider::HOME);
        }
        throw ValidationException::withMessages([
            'code' => trans("Invalid code"),
        ]);
    }

    public function resend2fa(User $user)
    {
        if(TwofaToken::where("email", $user->email)->first()) {
            TwofaToken::where('email', $user->email)->delete();
        }

        $code = '';
        for ($i = 0; $i < 6; $i++) {
            $code = $code.rand(0, 9);
        }

        TwofaToken::create([
            'email' => $user->email,
            'token' => Hash::make($code)
        ]);

        event(new TwofaEvent($user->email, $code));

        return back()->with('status', 'Authentication code sent!');
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
