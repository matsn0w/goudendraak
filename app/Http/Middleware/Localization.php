<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // get current language (or default)
        $lang = Session::get('locale') ?? config('app.locale');

        // check if the session has a language specified
        if (!Session::has('locale')) {
            // store the default locale in the session
            Session::put('locale', $lang);
        }

        // check if this is an API request
        if ($request->expectsJson()) {
            // get all available language keys
            $languages = array_keys(config('languages'));

            // get the requested language
            $lang = $request->getPreferredLanguage($languages);
        }

        // set the locale
        App::setlocale($lang);

        return $next($request);
    }
}
