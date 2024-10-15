<?php

declare(strict_types=1);

use Katalam\Mapbox\Dtos\Feature;

it('works', function () {
    $data = [
        'type' => 'Feature',
        'id' => 'dXJuOm1ieHBsYzpUZTQ2',
        'geometry' => [
            'type' => 'Point',
            'coordinates' => [
                13.386345,
                52.52792,
            ],
        ],
        'properties' => [
            'mapbox_id' => 'dXJuOm1ieHBsYzpUZTQ2',
            'feature_type' => 'postcode',
            'full_address' => '10115, Berlin, Germany',
            'name' => '10115',
            'name_preferred' => '10115',
            'coordinates' => [
                'longitude' => 13.386345,
                'latitude' => 52.52792,
            ],
            'place_formatted' => 'Berlin, Germany',
            'bbox' => [
                13.365861,
                52.523686,
                13.401329,
                52.540114,
            ],
            'context' => [
                'locality' => [
                    'mapbox_id' => 'dXJuOm1ieHBsYzpETkNxT2c',
                    'name' => 'Mitte',
                    'wikidata_id' => 'Q2013767',
                ],
                'place' => [
                    'mapbox_id' => 'dXJuOm1ieHBsYzpBY1E2',
                    'name' => 'Berlin',
                    'wikidata_id' => 'Q64',
                    'short_code' => 'DE-BE',
                ],
                'region' => [
                    'mapbox_id' => 'dXJuOm1ieHBsYzpBY1E2',
                    'name' => 'Berlin',
                    'wikidata_id' => 'Q64',
                    'region_code' => 'BE',
                    'region_code_full' => 'DE-BE',
                ],
                'country' => [
                    'mapbox_id' => 'dXJuOm1ieHBsYzpJam8',
                    'name' => 'Germany',
                    'wikidata_id' => 'Q183',
                    'country_code' => 'DE',
                    'country_code_alpha_3' => 'DEU',
                ],
                'postcode' => [
                    'mapbox_id' => 'dXJuOm1ieHBsYzpUZTQ2',
                    'name' => '10115',
                ],
            ],
        ],
    ];

    $feature = Feature::fromArray($data);

    expect($feature->id)->toBe('dXJuOm1ieHBsYzpUZTQ2')
        ->and($feature->geometry->type)->toBe('Point')
        ->and($feature->geometry->coordinates->getValue()->getLongitude())->toBe(13.386345)
        ->and($feature->geometry->coordinates->getValue()->getLatitude())->toBe(52.52792)
        ->and($feature->properties->mapboxId)->toBe('dXJuOm1ieHBsYzpUZTQ2')
        ->and($feature->properties->featureType)->toBe('postcode')
        ->and($feature->properties->fullAddress)->toBe('10115, Berlin, Germany')
        ->and($feature->properties->name)->toBe('10115')
        ->and($feature->properties->namePreferred)->toBe('10115')
        ->and($feature->properties->coordinates->getValue()->getLongitude())->toBe(13.386345)
        ->and($feature->properties->coordinates->getValue()->getLatitude())->toBe(52.52792)
        ->and($feature->properties->placeFormatted)->toBe('Berlin, Germany')
        ->and($feature->properties->bbox)->toBe([
            13.365861,
            52.523686,
            13.401329,
            52.540114,
        ])
        ->and($feature->properties->context->locality->mapboxId)->toBe('dXJuOm1ieHBsYzpETkNxT2c')
        ->and($feature->properties->context->locality->name)->toBe('Mitte')
        ->and($feature->properties->context->locality->wikidataId)->toBe('Q2013767')
        ->and($feature->properties->context->place->mapboxId)->toBe('dXJuOm1ieHBsYzpBY1E2')
        ->and($feature->properties->context->place->name)->toBe('Berlin')
        ->and($feature->properties->context->place->wikidataId)->toBe('Q64')
        ->and($feature->properties->context->place->shortCode)->toBe('DE-BE')
        ->and($feature->properties->context->region->mapboxId)->toBe('dXJuOm1ieHBsYzpBY1E2')
        ->and($feature->properties->context->region->name)->toBe('Berlin')
        ->and($feature->properties->context->region->wikidataId)->toBe('Q64')
        ->and($feature->properties->context->region->regionCode)->toBe('BE')
        ->and($feature->properties->context->region->regionCodeFull)->toBe('DE-BE')
        ->and($feature->properties->context->country->mapboxId)->toBe('dXJuOm1ieHBsYzpJam8')
        ->and($feature->properties->context->country->name)->toBe('Germany')
        ->and($feature->properties->context->country->wikidataId)->toBe('Q183')
        ->and($feature->properties->context->country->countryCode)->toBe('DE')
        ->and($feature->properties->context->country->countryCodeAlpha3)->toBe('DEU')
        ->and($feature->properties->context->postcode->mapboxId)->toBe('dXJuOm1ieHBsYzpUZTQ2')
        ->and($feature->properties->context->postcode->name)->toBe('10115');
});
