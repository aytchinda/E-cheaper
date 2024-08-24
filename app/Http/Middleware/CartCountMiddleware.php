<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\CartService;

class CartCountMiddleware
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function handle($request, Closure $next)
    {
        $cartCount = $this->cartService->getCartCount();
        view()->share('cartCount', $cartCount);

        return $next($request);
    }
}
