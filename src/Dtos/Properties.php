<?php

declare(strict_types=1);

namespace Katalam\Mapbox\Dtos;

use Katalam\Coordinates\Dtos\Coordinate;

class Properties
{
    public function __construct(
        public string $mapboxId,
        public string $featureType,
        public string $fullAddress,
        public string $name,
        public string $namePreferred,
        public Coordinate $coordinates,
        public string $placeFormatted,
        public array $bbox,
        public Context $context,
    ) {}

    public static function fromArray(array $properties): self
    {
        return new self(
            data_get($properties, 'mapbox_id'),
            data_get($properties, 'feature_type'),
            data_get($properties, 'full_address'),
            data_get($properties, 'name'),
            data_get($properties, 'name_preferred'),
            Coordinate::fromLatLng(
                data_get($properties, 'coordinates.latitude'),
                data_get($properties, 'coordinates.longitude'),
            ),
            data_get($properties, 'place_formatted'),
            data_get($properties, 'bbox'),
            Context::fromArray(data_get($properties, 'context')),
        );
    }
}
