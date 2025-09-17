<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /** @var array<string> */
    protected array $supported = ['en', 'fr']; // ajoute es, it, de quand tu veux

    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('locale');

        if (!$locale) {
            $locale = $request->getPreferredLanguage($this->supported) ?? config('app.locale');
        }

        if (!in_array($locale, $this->supported, true)) {
            $locale = config('app.fallback_locale');
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
