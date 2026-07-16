<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $publicHtmlPath = dirname(base_path()) . '/public_html';
        if (is_dir($publicHtmlPath)) {
            $this->app->usePublicPath($publicHtmlPath);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        if (config('app.url')) {
            \Illuminate\Support\Facades\URL::forceRootUrl(config('app.url'));
        }
        if (str_starts_with(config('app.url') ?? '', 'https://')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
