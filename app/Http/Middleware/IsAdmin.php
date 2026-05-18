<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Yeh middleware check karta hai ki logged in user admin hai ya nahi.
     * Agar admin nahi hai toh 403 error deta hai.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pehle check karo ki user logged in hai, phir role check karo
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Sirf admin yahan aa sakta hai.');
        }

        return $next($request);
    }
}
