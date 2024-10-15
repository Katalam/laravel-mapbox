<?php

declare(strict_types=1);

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Katalam\Coordinates\Dtos\Coordinate;
use Katalam\Mapbox\Facades\Mapbox;

describe('request api', function () {
    it('can get coordinate for postal code', function () {
        Http::fake([
            'https://api.mapbox.com/search/geocode/v6/forward*' => Http::response([
                'type' => 'FeatureCollection',
                'features' => [
                    [
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
                    ],
                ],
            ]),
        ]);

        $response = Mapbox::getPostalCode('10115');

        expect($response)->toBeInstanceOf(Collection::class)
            ->and($response->count())->toBe(1)
            ->and($response->first()->geometry->coordinates)->toBeInstanceOf(Coordinate::class);
    });
});
