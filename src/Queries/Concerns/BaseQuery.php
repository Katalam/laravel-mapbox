<?php

declare(strict_types=1);

namespace Katalam\Mapbox\Queries\Concerns;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Katalam\Mapbox\Dtos\Feature;
use Katalam\Mapbox\Dtos\MapboxRequest;
use Katalam\Mapbox\Exceptions\MapboxException;

class BaseQuery
{
    protected bool $permanent = false;

    protected string $country = '';

    protected string $language = '';

    protected int $limit = 5;

    protected string $types = '';

    protected string $worldview = '';

    public function setPermanent(bool $permanent): self
    {
        $this->permanent = $permanent;

        return $this;
    }

    public function setCountry(string|array $countries): self
    {
        if (is_string($countries)) {
            $this->country = $countries;
        } else {
            $this->country = implode(',', $countries);
        }

        return $this;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function setLimit(int $limit): self
    {
        $this->limit = max(min($limit, 10), 1);

        return $this;
    }

    public function setTypes(string|array $types): self
    {
        if (is_array($types)) {
            $types = implode(',', $types);
        }

        $this->types = $types;

        return $this;
    }

    public function setWorldview(string $worldview): self
    {
        $this->worldview = $worldview;

        return $this;
    }

    /**
     * @return Collection<Feature>
     */
    protected function mapFeatureCollection(array $data): Collection
    {
        return collect($data)->map(fn (array $data) => Feature::fromArray($data));
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
}
