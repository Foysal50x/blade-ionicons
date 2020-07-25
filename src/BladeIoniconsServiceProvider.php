<?php declare(strict_types=1);

namespace Faisal50x\BladeIonicons;

use BladeUI\Icons\Factory;
use Illuminate\Support\ServiceProvider;

class BladeIoniconsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/svg' => public_path('vendor/blade-ionicons'),
            ], 'blade-ionicons');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->callAfterResolving(Factory::class, function(Factory $factory){
            $factory->add('ionicons', [
                'path' => __DIR__ . '/../resources/svg',
                'prefix' => 'ionicon',
            ]);
        });
    }
}
