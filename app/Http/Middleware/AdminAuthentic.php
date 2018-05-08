<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Entities\User;
use function GuzzleHttp\Promise\all;

class AdminAuthentic
{
    public function handle($request, Closure $next, $guard=null)
    {
        if (Auth::guard($guard)->check()) {
        }
        return redirect('/home');
    }
}
