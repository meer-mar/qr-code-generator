<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class CheckRole
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle(Request $request, Closure $next, $role)
  {
    if (Auth::user()) {
      $authRole = Auth::user()->hasRole($role);
      $authlevel = $authRole ? Auth::user()->level() : false;

      if ($authlevel == 2) {
        return $next($request);
      } else if ($authlevel == 1) {
        return redirect(RouteServiceProvider::HOME);
      } else {
        abort(401);
      }
    }
    return redirect('/');
  }
}
