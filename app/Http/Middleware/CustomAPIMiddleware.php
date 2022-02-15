<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class CustomAPIMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $auth = $request->header('Authorization');
        $token = substr($auth, strpos($auth, ":") + 1);

        $user = User::where('api_token', $token)->first();
        if ($token && $user) {
            Auth::login($user);
            return $next($request);
        }else {
            abort(403);
        }
    }
}
