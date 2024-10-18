<?php

declare(strict_types=1);

namespace Katalam\Mapbox\Queries;

use Illuminate\Support\Collection;
use Katalam\Coordinates\Dtos\LatLng;
use Katalam\Mapbox\Dtos\MapboxRequest;
use Katalam\Mapbox\Exceptions\MapboxException;
use Katalam\Mapbox\Queries\Concerns\BaseQuery;

class ReverseQuery extends BaseQuery
{
    protected LatLng $latLng;

    protected int $limit = 1;

    public function setLatLng(LatLng $latLng): self
    {
        $this->latLng = $latLng;

        return $this;
    }

    public function setLatLngAsFloat(float $latitude, float $longitude): self
    {
        $this->latLng = new LatLng($latitude, $longitude);

        return $this;
    }

    public function setLimit(int $limit): self
    {
        $this->limit = max(min($limit, 5), 1);

        return $this;
    }

    /**
     * @throws MapboxException
     */
    public function get(): Collection
    {
        $parameters = [];
        if ($this->country !== '') {
            $parameters['country']  = $this->country;
        }
        if ($this->language !== '') {
            $parameters['language']  = $this->language;
        }
        if ($this->types !== '') {
            $parameters['types']  = $this->types;
        }
        if ($this->worldview !== '') {
            $parameters['worldview']  = $this->worldview;
        }


        $request = new MapboxRequest(
            'GET',
            'search/geocode/v6/reverse',
            queryParameters: [
                'longitude' => $this->latLng->getLongitude(),
                'latitude' => $this->latLng->getLatitude(),

                'permanent' => $this->permanent,
                'limit' => $this->limit,

                ...$parameters,
            ]
        );

        $response = $this->requestApi($request)
            ->json('features');

        return $this->mapFeatureCollection($response);
    }
}
