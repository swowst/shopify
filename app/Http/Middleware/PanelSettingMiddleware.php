<?php

namespace App\Http\Middleware;

use App\Models\SiteSetting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PanelSettingMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {

        $settings = SiteSetting::pluck('data', 'name' )->toArray();

        view()->share(['setting' => $settings]);
        return $next($request);
    }
}
