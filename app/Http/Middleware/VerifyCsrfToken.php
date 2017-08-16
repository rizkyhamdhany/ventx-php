<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Closure;
use Redirect;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    public function handle( $request, Closure $next )
    {
        if (
            $this->isReading($request) ||
            $this->runningUnitTests() ||
            $this->shouldPassThrough($request) ||
            $this->tokensMatch($request)
        ) {
            return $this->addCookieToResponse($request, $next($request));
        }
        $request->session()->flash('alert-danger', "<strong>You've been inactive for too long ! </strong> Sorry, to avoid faulty seat selection, please complete reservation within 15 minutes, thank you for your patience.!");
        return redirect($request->segment(1).'/'.$request->segment(2));
    }

    protected function shouldPassThrough($request)
    {
        foreach ($this->except as $except) {

            if (Str::is($except, $request->url())) {
                return true;
            }

            return false;
        }
    }
}
