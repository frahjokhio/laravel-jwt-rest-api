<?php

namespace App\Http\Middleware;

use Tymon\JWTAuth\Payload;
use Validator, JWTAuth;
use Session;


use Closure;

class WebValidateUser
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
        //dd('mid');
        $user = Session::get('usersession');
        
        if( empty($user) )
            return redirect('/');


        $userRepo = \App::make('UserRepository');

        $checkUserExist = $userRepo->findById($user->id);
        if( empty($checkUserExist) )
            return redirect('/login');

        $request['user_id'] = $user->id;
        return $next($request);
    }
}
