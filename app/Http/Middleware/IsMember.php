<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IsMember
 *
 * @author W.J
 */

namespace App\Http\Middleware;

use Closure;
use Session;
use Config;

class IsMember {

    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Session::has('member')) {
            return $next($request);
        }
        return redirect('/login');
        
    }

}
