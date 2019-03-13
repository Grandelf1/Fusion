<?php

namespace App\Packages\Config;

use App\Packages\Ci\CI;

/**
 * Class Config
 *
 * @package App\Packages\Config
 */
class Config
{

    /**
     * Get an item from the config or a default if the
     * given key doesn't exist.
     *
     * @param  string $key
     * @param  mixed $default
     *
     * @return mixed
     */
    public static function get(string $key, $default)
    {
        return CI::get('config')->item($key) ?? $default;
    }

    /**
     * Check if the item with the given key exists.
     *
     * @param  string $key
     *
     * @return bool
     */
    public static function has(string $key) : bool
    {
        return self::get($key) !== null;
    }
}
