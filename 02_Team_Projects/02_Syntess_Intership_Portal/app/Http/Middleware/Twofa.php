<?php

namespace App\Http\Middleware;

use App\Models\TwofaToken;
use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Twofa
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        $token = TwofaToken::where('email', $user->email)->first();
        if ($token) {
           return redirect()->route('request.2fa', ['user' => $user]);
        }
        return $next($request);
    }
}
