<?php

namespace App\Providers;

use App\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
        Route::bind('post', function ($id) {
            $query = Post::whereId($id);

            if ($this->isOnAdminRoute()) {
                $query->withDrafts();
            }

            return $query->first() ?? abort(404);
        });

    }

    /**
     * @return bool
     */
    protected function isOnAdminRoute()
    {
        return Str::startsWith(
            Route::current()->uri(),
            config('varbox.admin.prefix') . '/'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}