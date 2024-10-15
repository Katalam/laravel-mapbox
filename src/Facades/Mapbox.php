<?php

namespace Katalam\Mapbox\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Katalam\Mapbox\Mapbox
 */
class Mapbox extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Katalam\Mapbox\Mapbox::class;
    }
}
