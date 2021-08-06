<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
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
  public function handle(Request $request, Closure $next)
  {
    $roles = Role::all();

    if (Auth::user()) {
      $authRoles = Auth::user()->syncRoles($roles);
      dd($authRoles);
      $isAdmin = Auth::user()->checkRole('admin');

      if ($isAdmin) {
        return $next($request);
      }
      return redirect(RouteServiceProvider::HOME);
    }
    return redirect('/');
  }
}
