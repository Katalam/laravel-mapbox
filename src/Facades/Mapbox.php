<?php

declare(strict_types=1);

namespace Katalam\Mapbox\Facades;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Katalam\Mapbox\Mapbox
 *
 * @method static string getToken()
 * @method static array getCoordinateForPostalCode(string $postalCode)
 * @method static Collection mapGeoJsonFeatureCollectionToCoordinates(array $geoJson)
 */
class Mapbox extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Katalam\Mapbox\Mapbox::class;
    }
}
