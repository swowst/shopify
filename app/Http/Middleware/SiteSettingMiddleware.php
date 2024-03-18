<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\SiteSetting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SiteSettingMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $categories = Category::all();
        $settings = SiteSetting::pluck('data', 'name' )->toArray();

        view()->share(['setting' => $settings, 'categories' => $categories]);
        return $next($request);
    }
}
