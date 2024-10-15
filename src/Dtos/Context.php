<?php

declare(strict_types=1);

namespace Katalam\Mapbox\Dtos;

class Context
{
    public function __construct(
        public Locality $locality,
        public Place $place,
        public Region $region,
        public Country $country,
        public Postcode $postcode,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            Locality::fromArray(data_get($data, 'locality', [])),
            Place::fromArray(data_get($data, 'place', [])),
            Region::fromArray(data_get($data, 'region', [])),
            Country::fromArray(data_get($data, 'country', [])),
            Postcode::fromArray(data_get($data, 'postcode', [])),
        );
    }
}
