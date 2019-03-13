<?php

namespace App\Packages\View\Engines;

use \Smarty;

/**
 * Class SmartyEngine
 *
 * @package App\Packages\View\Engines
 */
class SmartyEngine extends Smarty implements Engine
{

    /**
     * SmartyEngine constructor
     */
    public function __construct()
    {
        parent::__construct();

        $this->template_dir = APPPATH;
        $this->compile_dir  = APPPATH . "cache/templates";
    }

    /**
     * Get the contents of a view.
     *
     * @param  string $path
     * @param  array  $data
     *
     * @return string
     */
    public function get(string $path, array $data = []) : string
    {
        foreach ($data as $key => $val) {
            $this->assign($key, $val);
        }

        return $this->fetch($path);
    }
}
