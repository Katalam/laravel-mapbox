<?php

namespace Katalam\Mapbox;

use Katalam\Mapbox\Commands\MapboxCommand;
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
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_mapbox_table')
            ->hasCommand(MapboxCommand::class);
    }
}
