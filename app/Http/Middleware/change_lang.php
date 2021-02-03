<?php

namespace App\Http\Middleware;

use Closure;

class change_lang
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
        if(session()->has('locale')){
            app()->setLocale(session()->get('locale'));
        }else{
            //get defualt lang from db
            //app()->setLocale(get_setting_by_key('default_language')->one_value);
            
            app()->setLocale('ar');
        }

        return $next($request);
    }
}
