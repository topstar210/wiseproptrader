<?php

namespace App\Http\Middleware;

use App\Admin_setting;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

/**
 * Class CheckForReadOnlyMode.
 */
class CheckForReadOnlyMode {
  /**
   * @var array
   */
  protected $disallowed = [
    'home',
    'profile',
  ];

  protected $maintenance_switch = false;
  protected $maintenance_message = '';

  /**
   * Handle an incoming request.
   *
   * @param \Illuminate\Http\Request $request
   * @param \Closure                 $next
   *
   * @return mixed
   */
  public function handle($request, Closure $next) {
    $AppSettings = Admin_setting::where('name', 'AppSettings')->first();
    if ($AppSettings) {
      $this->maintenance_switch = ($AppSettings->value1 == 'on') ? true : false;
      $this->maintenance_message = $AppSettings->value2 ?? '';
    }

    if ($this->maintenance_switch) {
        if (User::where('email', $request->input('email'))->value('role') != 1) {
            // auth()->logout();
            if ($request->path() == 'login' && $request->isMethod('post')) {
                abort(Response::HTTP_LOCKED, $this->maintenance_message);
            }
        }
    }

    return $next($request);
  }
}
