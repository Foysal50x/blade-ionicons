<?php

declare(strict_types=1);

namespace Faisal50x\BladeIonicons;

use BladeUI\Icons\Factory;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

final class BladeIoniconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();

        $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
            $config = $container->make('config')->get('blade-ionicons', []);

            $factory->add('ionicons', array_merge(['path' => __DIR__ . '/../resources/svg'], $config));
        });
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/blade-ionicons.php', 'blade-ionicons');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/svg' => public_path('vendor/blade-ionicons'),
            ], 'blade-si'); // TODO: updating this alias to `blade-ionicons` in next major release

            $this->publishes([
                __DIR__ . '/../config/blade-ionicons.php' => $this->app->configPath('blade-ionicons.php'),
            ], 'blade-ionicons-config');
        }
    }
}
