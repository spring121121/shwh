<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
            $url = Route::current()->uri();
            if(strpos($url,'wap')===false){
                return response()->json([
                    'status' => false,
                    'code' => 50010,
                    'message' => isset($message) ? $message : config('errorcode.code')[50010],
                    'data' => [],
                ]);
            }else{
                return redirect('/wap/login_index');
            }

        }
        return $next($request);
    }
}
