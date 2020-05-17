<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Telescope
        if ($this->app->isLocal()) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        config([
            'global' => Setting::all([
                'name', 'value'
            ])->keyBy('name')->transform(function ($setting) {
                return $setting->value;
            })->toArray()
        ]);
    }
}
