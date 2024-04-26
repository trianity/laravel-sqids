<?php

declare(strict_types=1);

namespace Trianity\Sqids\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string encode(mixed ...$numbers)
 * @method static array decode(string $hash)
 */
class Sqids extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'sqids';
    }
}
