<?php

namespace App\Contracts;

interface StorageContract
{
    public function add(mixed $key, string $value);

    public function get(mixed $key);

    public function remove(mixed $key, string $value);
}
