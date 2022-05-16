<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Redirect\RedirectByContentHelper;

class RedirectIfAuthenticated
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @param  string|null  ...$guards
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next, ...$guards)
  {
    $guards = empty($guards) ? [null] : $guards;
    foreach ($guards as $guard) {

      if ($request->routeIs('admin.*') and Auth::guard($guard)->check() and $guard === 'admin') {
        return redirect(route('admin.home'));
      }

      if (Auth::guard($guard)->check() and $guard !== 'admin') {

        $user = Auth::guard($guard)->user()->load(['packages']);
        $redirect_to = $user->packages->first()->redirect_content;

        return redirect(RedirectByContentHelper::getPath($redirect_to));
      }
    }

    return $next($request);
  }
}
