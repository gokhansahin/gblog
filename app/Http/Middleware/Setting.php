<?php

namespace App\Http\Middleware;

use App\Settings\SocialSettings;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Setting
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $social = app(\App\Settings\SocialSettings::class);

        view()->share('social', $social->links);

        return $next($request);
    }
}
