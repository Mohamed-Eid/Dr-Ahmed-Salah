<?php

namespace App\Http\Middleware;

use Closure;
use RealRashid\SweetAlert\Facades\Alert;

class DoctorMiddleware
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
        
        if(is_doctor())
        {
            return $next($request);
        }else{
            Alert::error('403', "You Aren't Authorize to do this action");
        
            return redirect()->back();
        }

    }
}
