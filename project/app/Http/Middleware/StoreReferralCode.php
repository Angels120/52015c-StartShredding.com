<?php

namespace App\Http\Middleware;

use App\ReferralLink;
use Closure;

class StoreReferralCode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($request->has('signup_code')) {
            $referral = ReferralLink::whereCode($request->input('signup_code'))->first();
            if ($referral) {
                $response->cookie('ref', $referral->id, $referral->lifetime_minutes);
                // Cookie::set('ref', $referral->id, $referral->lifetime_minutes);
            }
        }

        return $response;
    }
}
