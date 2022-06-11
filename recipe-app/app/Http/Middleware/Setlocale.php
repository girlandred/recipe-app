<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\App;

use Closure;

class Setlocale
{
    public function handle($request, Closure $next)
    {
        $locale = session('locale');
        App::setLocale($locale);
        return $next($request);
    }
}
