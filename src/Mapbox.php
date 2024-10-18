<?php

declare(strict_types=1);

namespace Katalam\Mapbox;

use Illuminate\Support\Facades\Config;
use Katalam\Mapbox\Queries\ForwardQuery;
use Katalam\Mapbox\Queries\ReverseQuery;

class Mapbox
{
    public function __construct() {}

    public function getToken(): string
    {
        return Config::get('mapbox.token', '') ?? '';
    }

    public function forward(): ForwardQuery
    {
        return new ForwardQuery;
    }

    public function reverse(): ReverseQuery
    {
        return new ReverseQuery;
    }
}
