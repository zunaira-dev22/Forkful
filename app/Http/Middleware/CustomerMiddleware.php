<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || $request->user()->role !== 'customer') {
            return redirect()->route('home')
                ->with('error', 'This page is only available to customers.');
        }

        return $next($request);
    }
}