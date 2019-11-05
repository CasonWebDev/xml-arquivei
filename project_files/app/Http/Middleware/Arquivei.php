<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class Arquivei
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
        $api_token = $request->header('api-token');

        if($api_token != env('API_TOKEN')) {
            $simulated['success'] = false;
            $simulated['error'] = 'API Token Inválido';

            return (new Response($simulated, 401))
                ->header('Content-Type', 'application/json');
        }

        return $next($request);
    }
}
