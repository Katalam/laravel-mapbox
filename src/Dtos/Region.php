<?php

declare(strict_types=1);

namespace Katalam\Mapbox\Dtos;

class Region
{
    public function __construct(
        public string $mapboxId,
        public string $name,
        public string $wikidataId,
        public string $regionCode,
        public string $regionCodeFull,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            data_get($data, 'mapbox_id'),
            data_get($data, 'name'),
            data_get($data, 'wikidata_id'),
            data_get($data, 'region_code'),
            data_get($data, 'region_code_full'),
        );
    }
}
