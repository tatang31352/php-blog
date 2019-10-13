<?php

namespace App\Http\Middleware;



use Closure;

class CheckAge
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
        if($request->name >200)
        {
            return $next($request);
        }else
        {
           return $response->getContent();
        }
    }
}
