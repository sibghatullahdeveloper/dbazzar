<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Model\Cart;
class RedirectIfCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'customer')
    {
       // dd(Auth::guard($guard)->check(), $next ,$request);

        if (Auth::guard($guard)->check()) {
            $cart = Cart::where('user_id',Auth::guard('customer')->user()->id)->get();
            if($cart->isEmpty()){
             return redirect(route('myaccount'));
        }
       else
       {
        return redirect(route('Checkout'));
       }
        }

        return $next($request);
    }
}
