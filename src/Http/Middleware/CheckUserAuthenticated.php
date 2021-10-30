<?php

namespace Gglink\CrudPermission\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // check user token exist is session which was set during login
        // token nit exist then redirect to login page
        if ($request->session()->get('token') == '') {
            return redirect()->route('users.login.form');
        }
        return $next($request);
    }
}
