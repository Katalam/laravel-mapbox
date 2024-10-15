<?php

declare(strict_types=1);

namespace Katalam\Mapbox;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MapboxServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-mapbox')
            ->hasConfigFile();
    }

    public function bootingPackage(): void
    {
        Http::macro('mapbox', function () {
            return Http::withHeaders(Config::get('mapbox.headers'))
                ->baseUrl(Config::get('mapbox.base_url'));
        });
    }
}
