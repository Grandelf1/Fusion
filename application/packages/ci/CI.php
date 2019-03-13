<?php

namespace App\Packages\Ci;

use Exception;
use CI_Controller;

/**
 * Class CI
 *
 * @package App\Packages\Ci
 */
class CI
{

    /**
     * Fetch a property from the Code Igniter controller.
     */
    public static function get(string $name)
    {
        $instance = self::getInstance();

        if (!property_exists($instance, $name)) {
            throw new Exception('Property '.$name.' not found in CI instance.');
        }

        return $instance->{$name};
    }

    /**
     * Get the Code Igniter instance.
     *
     * @return CI_Controller
     */
    private static function getInstance() : CI_Controller
    {
        return get_instance();
    }
}
