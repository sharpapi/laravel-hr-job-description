<?php

declare(strict_types=1);

namespace SharpAPI\HrJobDescription;

use Illuminate\Support\ServiceProvider;

/**
 * @api
 */
class HrJobDescriptionProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/sharpapi-hr-job-description.php' => config_path('sharpapi-hr-job-description.php'),
            ], 'sharpapi-hr-job-description');
        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Merge the package configuration with the app configuration.
        $this->mergeConfigFrom(
            __DIR__.'/../config/sharpapi-hr-job-description.php', 'sharpapi-hr-job-description'
        );
    }
}