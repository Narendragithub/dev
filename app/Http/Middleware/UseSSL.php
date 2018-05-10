<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use App\Settings;

class UseSSL {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $settings = Settings::find(1);

        if ($settings->use_ssl == 1) {
            if (!$request->secure()) {
                return redirect()->secure($request->path());
            }
        } else {
            if ($request->secure()) {
                return redirect()->to($request->getRequestUri(), 302, array(), false);
            }
        }


        return $next($request);
    }

}
