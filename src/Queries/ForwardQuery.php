<?php

declare(strict_types=1);

namespace Katalam\Mapbox\Queries;

use Illuminate\Support\Collection;
use Katalam\Mapbox\Dtos\ForwardQueryStructuredInput;
use Katalam\Mapbox\Dtos\MapboxRequest;
use Katalam\Mapbox\Exceptions\MapboxException;
use Katalam\Mapbox\Exceptions\MapboxQueryException;
use Katalam\Mapbox\Queries\Concerns\BaseQuery;

class ForwardQuery extends BaseQuery
{
    protected string $query = '';

    protected ?ForwardQueryStructuredInput $queryStructuredInput = null;

    protected bool $autoComplete = true;

    protected array $bbox = [];

    protected string $format = 'geojson';

    protected string $proximity = '';

    /**
     * @throws MapboxQueryException
     */
    public function setQuery(string $query): self
    {
        $queryEncoded = urlencode($query);

        if (strlen($queryEncoded) > 256) {
            throw new MapboxQueryException('Query string is too long. It must be less than 256 characters.');
        }
        if (str_contains($query, ';') || str_contains($queryEncoded, ';')) {
            throw new MapboxQueryException('Query string cannot contain ";" characters.');
        }
        if (count(explode(' ', $query)) > 20) {
            throw new MapboxQueryException('Query string cannot contain more than 20 words.');
        }

        $this->query = $query;

        return $this;
    }

    public function setStructuredInput(ForwardQueryStructuredInput $queryStructuredInput): self
    {
        $this->queryStructuredInput = $queryStructuredInput;

        return $this;
    }

    public function setAutoComplete(bool $autoComplete): self
    {
        $this->autoComplete = $autoComplete;

        return $this;
    }

    public function setBbox(int $minLon, int $minLat, int $maxLon, int $maxLat): self
    {
        $this->bbox = [
            $minLon,
            $minLat,
            $maxLon,
            $maxLat,
        ];

        return $this;
    }

    public function removeBbox(): self
    {
        $this->bbox = [];

        return $this;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function setProximity(string $longitude, ?string $latitude = null): self
    {
        if (func_num_args() === 1) {
            $this->proximity = $longitude;

            return $this;
        }

        $this->proximity = "$longitude,$latitude";

        return $this;
    }

    /**
     * @throws MapboxException
     */
    public function get(): Collection
    {
        $parameters = [];
        if ($this->country !== '') {
            $parameters['country'] = $this->country;
        }
        if ($this->language !== '') {
            $parameters['language'] = $this->language;
        }
        if ($this->types !== '') {
            $parameters['types'] = $this->types;
        }
        if ($this->worldview !== '') {
            $parameters['worldview'] = $this->worldview;
        }
        if (count($this->bbox) > 0) {
            $parameters['bbox'] = implode(',', $this->bbox);
        }
        if ($this->proximity !== '') {
            $parameters['proximity'] = $this->proximity;
        }

        $request = new MapboxRequest(
            'GET',
            'search/geocode/v6/forward',
            queryParameters: [
                'permanent' => $this->permanent,
                'limit' => $this->limit,
                'format' => $this->format,

                ...$parameters,
            ]
        );

        $response = $this->requestApi($request)
            ->json('features');

        return $this->mapFeatureCollection($response);
    }
}
