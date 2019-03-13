<?php

namespace App\Packages\View\Engines;

/**
 * Interface Engine
 *
 * @package App\Packages\View\Engine
 */
interface Engine
{

    /**
     * Get the contents of a view.
     *
     * @param  string $path
     * @param  array  $data
     *
     * @return string
     */
    public function get(string $path, array $data = []) : string;
}
