<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use PHPUnit\Util\Exception;

class EnsureTokenIsValid
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
        dd($request->input());
        if($request->input('token') !== 'my-secret-token') {
            return response("unauthorize", 401);
        }

        return $next($request);
    }
}
