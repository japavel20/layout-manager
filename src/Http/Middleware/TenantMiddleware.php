<?php

namespace Layout\Manager\Http\Middleware;

use Closure;
use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $host = $request->getHost();
        $tenant = Tenant::where('domain', $host)->first();

        if (!$tenant) {
            abort(404, 'Tenant not found');
        }

        // Set tenant ID in session
        session(['tenant_id' => $tenant->id]);

        return $next($request);
    }
}
