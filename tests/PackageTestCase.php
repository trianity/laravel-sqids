<?php

declare(strict_types=1);

namespace Trianity\Hashids\Tests;

use Orchestra\Testbench\TestCase;
use Trianity\Hashids\Providers\PackageServiceProvider;

class PackageTestCase extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            PackageServiceProvider::class,
        ];
    }
}
