<?php

declare(strict_types=1);

namespace Katalam\Mapbox\Dtos;

use Katalam\Mapbox\Facades\Mapbox;
use RuntimeException;

class MapboxRequest
{
    public function __construct(
        public string $method,
        public string $path,
        public array $parameters = [],
        public array $queryParameters = [],
    ) {}

    public function getMethod(): string
    {
        $method = strtoupper($this->method);

        if (! in_array($method, [
            'GET',
            'POST',
            'PUT',
            'PATCH',
            'DELETE',
            'HEAD',
            'OPTIONS',
        ])) {
            throw new RuntimeException('Invalid method');
        }

        return $method;
    }

    public function getPathWithData(): string
    {
        $path = $this->path;
        if (str_ends_with($this->path, '?')) {
            $path = substr($this->path, 0, -1);
        }

        $queryParameters = $this->queryParameters;

        if (! isset($queryParameters['access_token'])) {
            $queryParameters['access_token'] = Mapbox::getToken();
        }

        return $path.'?'.http_build_query($queryParameters);
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }
}
