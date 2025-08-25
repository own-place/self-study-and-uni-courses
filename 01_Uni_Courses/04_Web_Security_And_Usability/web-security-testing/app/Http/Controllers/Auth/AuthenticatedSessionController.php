<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;

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
        // Check if the user has reached the maximum number of login attempts
        if ($this->hasExceededMaxAttempts($request)) {
            return back()->withErrors(['email' => 'Your account is temporarily locked. Please try again later.']);
        }

        // Attempt to authenticate the user
        if (!Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            // Increment the login attempts for the user
            $this->incrementLoginAttempts($request);
            return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
        }

        // Clear the login attempts for the user
        $this->clearLoginAttempts($request);

        $request->session()->regenerate();

        return redirect()->intended(route('welcome', absolute: false));
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

    /**
     * Check if the user has exceeded the maximum number of login attempts.
     */
    protected function hasExceededMaxAttempts(Request $request): bool
    {
        return Cache::has($this->getLoginAttemptsKey($request)) && Cache::get($this->getLoginAttemptsKey($request)) >= 3;
    }

    /**
     * Increment the login attempts for the user.
     */
    protected function incrementLoginAttempts(Request $request): void
    {
        $attempts = Cache::get($this->getLoginAttemptsKey($request), 0);
        Cache::put($this->getLoginAttemptsKey($request), $attempts + 1, now()->addMinutes(1));
    }

    /**
     * Clear the login attempts for the user.
     */
    protected function clearLoginAttempts(Request $request): void
    {
        Cache::forget($this->getLoginAttemptsKey($request));
    }

    /**
     * Get the cache key for login attempts.
     */
    protected function getLoginAttemptsKey(Request $request): string
    {
        return 'login_attempts_' . sha1($request->ip());
    }
}
