<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
  /**
   * Get the path the user should be redirected to when they are not authenticated.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return string|null
   */
  protected function redirectTo($request)
  {
    if (!$request->expectsJson()) {
      return $request->routeIs('admin.*') ? route('admin.login') : route('home');
    }
  }

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle($request, Closure $next, ...$guards)
  {
    if ($request->routeIs('admin.*') or in_array('admin', $guards, true)) {

      if (!auth('admin')->check()) {
        return redirect()->route('admin.login');
      }

    } else {

      if (!auth('web')->check()) {
        return redirect()->route('home');
      }
    }

    return $next($request);
  }
}
