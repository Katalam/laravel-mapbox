<?php

declare(strict_types=1);

namespace Katalam\Mapbox\Dtos;

class Feature
{
    public function __construct(
        public string $id,
        public Geometry $geometry,
        public Properties $properties,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: data_get($data, 'id', ''),
            geometry: Geometry::fromArray(data_get($data, 'geometry', [])),
            properties: Properties::fromArray(data_get($data, 'properties', [])),
        );
    }
}
