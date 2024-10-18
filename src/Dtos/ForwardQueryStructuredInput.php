<?php

declare(strict_types=1);

namespace Katalam\Mapbox\Dtos;

class ForwardQueryStructuredInput
{
    public function __construct(
        public string $addressLine1 = '',
        public string $addressNumber = '',
        public string $street = '',
        public string $block = '',
        public string $place = '',
        public string $region = '',
        public string $postcode = '',
        public string $locality = '',
        public string $neighborhood = '',
        public string $country = '',
    ) {}
}
