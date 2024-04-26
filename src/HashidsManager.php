<?php

declare(strict_types=1);

namespace Trianity\Hashids;

use GrahamCampbell\Manager\AbstractManager;
use Hashids\Hashids;
use Illuminate\Contracts\Config\Repository;

/**
 * @method string encode(mixed ...$numbers)
 * @method array decode(string $hash)
 * @method string encodeHex(string $str)
 * @method string decodeHex(string $hash)
 */
class HashidsManager extends AbstractManager
{
    protected HashidsFactory $factory;

    public function __construct(Repository $config, HashidsFactory $factory)
    {
        parent::__construct($config);

        $this->factory = $factory;
    }

    public function getFactory(): HashidsFactory
    {
        return $this->factory;
    }

    protected function createConnection(array $config): Hashids
    {
        return $this->factory->make($config);
    }

    protected function getConfigName(): string
    {
        return 'hashids';
    }
}
