<?php

declare(strict_types=1);

namespace Trianity\Sqids\Tests;

use Orchestra\Testbench\TestCase;
use Trianity\Sqids\Providers\PackageServiceProvider;

class PackageTestCase extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            PackageServiceProvider::class,
        ];
    }
}
