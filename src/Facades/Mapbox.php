<?php

declare(strict_types=1);

namespace Katalam\Mapbox\Facades;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;
use Katalam\Mapbox\Queries\ForwardQuery;
use Katalam\Mapbox\Queries\ReverseQuery;

/**
 * @see \Katalam\Mapbox\Mapbox
 *
 * @method static string getToken()
 * @method static ForwardQuery forward()
 * @method static ReverseQuery reverse()
 */
class Mapbox extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Katalam\Mapbox\Mapbox::class;
    }
}
