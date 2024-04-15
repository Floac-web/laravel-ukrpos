<?php

namespace Floac\Ukrpost;

use Floac\Ukrpost\AddressClassifier\Dictionary;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/ukrpost.php', 'ukrpost');

        $this->publishes([
            __DIR__ . '/../config/ukrpost.php' => config_path('ukrpost.php')
        ]);
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        app()->bind('ukrpost-dictionary', Dictionary::class);
    }
}
