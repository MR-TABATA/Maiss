<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
  /**
   * The model to policy mappings for the application.
   *
   * @var array<class-string, class-string>
   */
  protected $policies = [
    //
  ];

  /**
   * Register any authentication / authorization services.
   */
  public function boot(): void
  {
    $this->registerPolicies();

    // 組合員ユーザ以上（つまり全権限）に許可
    Gate::define('user', function ($user) {
      return ($user->role >= 1);
    });

    // 役員に許可
    Gate::define('board', function ($user) {
      return ($user->role >= 5);
    });

    // 理事長（管理者）に許可
    Gate::define('chairman', function ($user) {
      return ($user->role >= 10);
    });

    // システム管理者に許可
    Gate::define('superadmin', function ($user) {
      return ($user->role == 11);
    });

    // 管理会社のみ許可
    Gate::define('company', function ($user) {
      return ($user->role == 20);
    });


  }
}
