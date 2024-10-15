<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use Katalam\Mapbox\Tests\TestCase;

uses(TestCase::class)
    ->beforeEach(fn () => Http::preventStrayRequests())
    ->in(__DIR__);
