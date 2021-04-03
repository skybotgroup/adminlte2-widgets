<?php

namespace Skybotgroup\ALTE2Widgets;

use Illuminate\Support\ServiceProvider;

class ALTE2WidgetsServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(ALTE2Widgets $extension)
    {
        if (! ALTE2Widgets::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'adminlte2-widgets');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/laravel-admin-ext/adminlte2-widgets')],
                'adminlte2-widgets'
            );
        }

        $this->app->booted(function () {
            ALTE2Widgets::routes(__DIR__.'/../routes/web.php');
        });
    }
}