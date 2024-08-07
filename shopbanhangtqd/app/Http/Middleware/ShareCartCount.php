<?php
namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\GioHangController;

class ShareCartCount
{
    public function handle($request, Closure $next)
    {
        $cartCount = (new GioHangController())->getCartCount();
        view()->share('cartItemCount', $cartCount);

        return $next($request);
    }
}