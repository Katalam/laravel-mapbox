<?php

declare(strict_types=1);

namespace Katalam\Mapbox\Dtos;

use Katalam\Coordinates\Dtos\Coordinate;

class Geometry
{
    public function __construct(
        public string $type,
        public Coordinate $coordinates,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            type: data_get($data, 'type'),
            coordinates: Coordinate::fromLatLng(
                data_get($data, 'coordinates.1'),
                data_get($data, 'coordinates.0'),
            ),
        );
    }
}
