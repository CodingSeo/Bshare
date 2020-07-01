<?php
<<<<<<< HEAD
=======

>>>>>>> e717b340196c96b3b7f6538e0d9670f96d8795a3
namespace App\Http\Middleware;

use Closure;

class Cors
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
<<<<<<< HEAD
        return $next($request)
          ->header("Access-Control-Allow-Origin", "*")
          ->header("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, OPTIONS")
          ->header("Access-Control-Allow-Headers", "X-Requested-With, Content-Type, X-Token-Auth, Authorization");
    }
}

    
=======
        return $next($request);
    }
}
>>>>>>> e717b340196c96b3b7f6538e0d9670f96d8795a3
