<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class csrf
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
       // Ambil token CSRF dari request
       $token = $request->header('X-CSRF-TOKEN') ?: $request->input('_token');

       // Periksa apakah token valid
       if (!$token || !hash_equals($token, session()->token())) {
           // Jika token tidak valid, kembalikan error 403
         return  abort(403, 'You do not have permission to access this resource.');
       }

       // Lanjutkan request jika token valid
       return $next($request);
    }
}
