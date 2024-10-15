<?php

declare(strict_types=1);

// config for Katalam/Mapbox
return [
    /**
     * The base URL of the MapBox API.
     */
    'base_url' => 'https://api.mapbox.com',

    /**
     * The headers to be sent with the request.
     * Override this if you need to send additional headers.
     */
    'headers' => [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
    ],

    /**
     * The Mapbox API key.
     */
    'token' => env('MAPBOX_API_KEY', ''),
];
