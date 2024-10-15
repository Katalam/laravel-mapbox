<?php

declare(strict_types=1);

namespace Katalam\Mapbox;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Katalam\Mapbox\Dtos\MapboxRequest;

class Mapbox
{
    public function __construct() {}

    public function getToken(): string
    {
        return Config::get('mapbox.token', '') ?? '';
    }

    public function requestApi(MapboxRequest $request): Response
    {
        $parameters = $request->getParameters();

        // when we have a get request,
        // the parameter array will override the query parameters
        if ($request->getMethod() === 'GET') {
            $parameters = null;
        }

        return Http::mapbox()
            ->{$request->getMethod()}($request->getPathWithData(), $parameters);
    }

    public function getCoordinateForPostalCode(string $postalCode): array
    {
        $request = new MapboxRequest(
            'GET',
            'search/geocode/v6/forward',
            queryParameters: [
                'postcode' => $postalCode,
            ],
        );

        return $this->requestApi($request)
            ->json('features');
    }
}
