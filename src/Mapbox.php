<?php

declare(strict_types=1);

namespace Katalam\Mapbox;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Katalam\Mapbox\Dtos\Feature;
use Katalam\Mapbox\Dtos\MapboxRequest;
use Katalam\Mapbox\Exceptions\MapboxException;

class Mapbox
{
    public function __construct() {}

    public function getToken(): string
    {
        return Config::get('mapbox.token', '') ?? '';
    }

    /**
     * @throws MapboxException
     */
    public function requestApi(MapboxRequest $request): Response
    {
        $parameters = $request->getParameters();

        // when we have a get request,
        // the parameter array will override the query parameters
        if ($request->getMethod() === 'GET') {
            $parameters = null;
        }

        $response = Http::mapbox()
            ->{$request->getMethod()}($request->getPathWithData(), $parameters);

        $this->throwIfResponseFailed($response);

        return $response;
    }

    /**
     * @throws MapboxException
     */
    protected function throwIfResponseFailed(Response $response): void
    {
        if ($response->failed()) {
            throw new MapboxException($response->json('message'), $response->status());
        }
    }

    /**
     * @return Collection<Feature>
     */
    protected function mapFeatureCollection(array $data): Collection
    {
        return collect($data)->map(fn (array $data) => Feature::fromArray($data));
    }

    /**
     * @return Collection<Feature>
     * @throws MapboxException
     */
    public function getPostalCode(string $postalCode): Collection
    {
        $request = new MapboxRequest(
            'GET',
            'search/geocode/v6/forward',
            queryParameters: [
                'postcode' => $postalCode,
            ],
        );

        $data = $this->requestApi($request)
            ->json('features');

        return $this->mapFeatureCollection($data);
    }
}
