<?php
/**
 * Middleware to validate parcel data in delivery requests.
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateParcelData
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
            'width'   => 'required|numeric',
            'height'  => 'required|numeric',
            'length'  => 'required|numeric',
            'weight'  => 'required|numeric',
            'courier' => 'required|string|in:justin,ukrposhta,novaposhta',
        ]);

        return $next($request);
    }
}
