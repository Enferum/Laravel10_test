<?php

namespace App\Services;

use App\Contracts\StorageContract;
use Predis\Client;

class RedisService implements StorageContract
{
    public function __construct(protected Client $client)
    {
    }

    public function add(mixed $key, string $value): void
    {
        $this->client->sadd($key, [$value]);
    }

    public function get(mixed $key): array
    {
        return $this->client->smembers($key);
    }

    public function remove($key, $value): int
    {
        return $this->client->srem($key, $value);
    }

    // check expire time for link
}
