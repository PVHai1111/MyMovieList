<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/login')->withErrors(['error_loggin'=> 'You need to login to continue.']);
        }

        // Kiểm tra role của người dùng có phải là 'admin'
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->withErrors(['error_permission'=> 'You do not have access.']);
        }

        // Cho phép tiếp tục nếu là admin
        return $next($request);
    }
}
