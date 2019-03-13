<?php

namespace App\Packages\Http;

use App\Packages\Ci\CI;

/**
 * Class Router
 *
 * @package App\Packages\Http
 */
class Router
{

    /**
     * Get the currently active module, if one is active.
     * Returns an empty string if none is active.
     *
     * @return string
     */
    public static function getActiveModule() : string
    {
        return CI::get('router')->fetch_module() ?? '';
    }
}
