<?php

declare(strict_types=1);

namespace Trianity\Hashids;

use Hashids\Hashids;
use Illuminate\Support\Arr;

class HashidsFactory
{
    public function make(array $config): Hashids
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    protected function getConfig(array $config): array
    {
        return [
            'salt' => Arr::get($config, 'salt', ''),
            'length' => Arr::get($config, 'length', 0),
            'alphabet' => Arr::get($config, 'alphabet', 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'),
        ];
    }

    protected function getClient(array $config): Hashids
    {
        return new Hashids($config['salt'], $config['length'], $config['alphabet']);
    }
}
