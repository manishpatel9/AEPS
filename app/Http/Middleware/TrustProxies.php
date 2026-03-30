<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     * Set to '*' to trust all proxies (use with care), or set from env.
     *
     * @var array|string|null
     */
    protected $proxies;

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;

    public function __construct()
    {
        // Allow configuring trusted proxies via TRUSTED_PROXIES env (comma-separated)
        $proxies = env('TRUSTED_PROXIES');
        $this->proxies = $proxies === '*' || $proxies === null ? $proxies : array_map('trim', explode(',', $proxies));
    }
}
