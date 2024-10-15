<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Config;
use Katalam\Mapbox\Dtos\MapboxRequest;

it('can construct', function () {
    $request = new MapboxRequest('GET', 'path');

    expect($request)->toBeInstanceOf(MapboxRequest::class);
});

it('can append the access token', function () {
    $request = new MapboxRequest('GET', 'path');

    Config::set('mapbox.token', '1234');

    expect($request->getPathWithData())->toBe('path?access_token=1234');
});

it('can will remove duplicated question marks', function () {
    $request = new MapboxRequest('GET', 'path?');

    Config::set('mapbox.token', '1234');

    expect($request->getPathWithData())->toBe('path?access_token=1234');
});

it('can return the parameters', function () {
    $request = new MapboxRequest('GET', 'path', ['foo' => 'bar']);

    expect($request->getParameters())->toBe(['foo' => 'bar']);
});

it('can return the method', function () {
    $request = new MapboxRequest('GET', 'path');

    expect($request->getMethod())->toBe('GET');
});

it('will throw an exception for invalid methods', function () {
    $request = new MapboxRequest('INVALID', 'path');

    $request->getMethod();
})->throws(RuntimeException::class, 'Invalid method');
