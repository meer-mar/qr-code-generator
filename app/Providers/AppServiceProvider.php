<?php

namespace App\Providers;

use App\Models\AppSetting;
use App\Models\WebSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot(AppSetting $appSetting, WebSetting $webSetting)
  {
    // Get admin dashbaord basic settings
    $appSettings = $appSetting->where('id', 1)->first();
    View::share('appSettings', $appSettings);

    // Get website basic settings
    $webSettings = $webSetting->where('id', 1)->first();
    View::share('webSettings', $webSettings);

    // Custom blade directives //
    Blade::if('level', function ($level) {
      return Auth::check() && Auth::user()->level() == $level;
    });

    Blade::if('permission', function ($permission) {
      return Auth::check() && Auth::user()->checkPermission($permission);
    });
    // Custom blade directives //

    // Use Tailwind pagination for Laravel 12
    Paginator::useTailwind();
  }
}
