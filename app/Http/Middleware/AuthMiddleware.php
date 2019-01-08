<?php

namespace App\Http\Middleware;

use Closure;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $userInfo = $request->session()->get('userInfo');


        if(empty($userInfo)){
           return redirect('/wap/login');
        }
        return $next($request);
    }
}
