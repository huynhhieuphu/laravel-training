<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->age < 18) {
            return response('Chưa đủ 18 tuổi');

            //return dd(response('Chưa đủ 18 tuổi'));
            //Khi thực hiện một số công việc nào đó trong middleware
            // thì sau khi kết thúc bạn phải return một object chứa thuộc tính headers
            // return redirect($URI);
            // return response($data);
            // return $next($request);
        }

        echo 'Filter by route (Middleware Route) <br>';
        return $next($request);
    }
}
