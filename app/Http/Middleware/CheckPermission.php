<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\PermissionDeniedException;

class CheckPermission
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle(Request $request, Closure $next, $permission)
  {
    if (Auth::user()) {
      // try {
      //   Auth::user()->checkPermission($permission);
      //   dd('up: ', $authPermission);
      // } catch (PermissionDeniedException $exception) {
      //   dd('down: ', $exception);
      // }
      // return $next($request);
      if (Auth::user()->checkPermission($permission)) {
        return $next($request);
      }

      throw new PermissionDeniedException;
    }
  }
}
