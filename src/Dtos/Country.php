<?php

declare(strict_types=1);

namespace Katalam\Mapbox\Dtos;

class Country
{
    public function __construct(
        public string $mapboxId,
        public string $name,
        public string $wikidataId,
        public string $countryCode,
        public string $countryCodeAlpha3,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            data_get($data, 'mapbox_id'),
            data_get($data, 'name'),
            data_get($data, 'wikidata_id'),
            data_get($data, 'country_code'),
            data_get($data, 'country_code_alpha_3'),
        );
    }
}
