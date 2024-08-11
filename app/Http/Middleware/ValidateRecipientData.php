<?php
/**
 * Middleware to validate recipient data in delivery requests.
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateRecipientData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $request->validate([
            'full_name'    => 'required|string',
            'phone_number' => 'required|string',
            'email'        => 'required|email',
            'address'      => 'required|string',
        ]);

        return $next($request);
    }
}
