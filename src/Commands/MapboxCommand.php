<?php

declare(strict_types=1);

namespace Katalam\Mapbox\Commands;

use Illuminate\Console\Command;

class MapboxCommand extends Command
{
    public $signature = 'laravel-mapbox';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
