<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $publicHtmlPath = dirname(base_path()).'/public_html';
        if (is_dir($publicHtmlPath) && file_exists($publicHtmlPath.'/index.php')) {
            $this->app->usePublicPath($publicHtmlPath);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        // Local links must follow the current request host, scheme and port.
        if (! $this->app->environment('local', 'testing')) {
            if (config('app.url')) {
                URL::forceRootUrl(config('app.url'));
            }
            if (str_starts_with(config('app.url') ?? '', 'https://')) {
                URL::forceScheme('https');
            }
        }
    }
}
