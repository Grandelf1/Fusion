<?php

namespace App\Packages\View;

use App\Packages\Config\Config;
use App\Packages\Http\Response;
use App\Packages\Http\Router;
use App\Packages\View\Exceptions\ViewNotFoundException;

/**
 * Class Template
 *
 * @package App\Packages\View
 */
class Template
{

    /**
     * Collection of possible view paths.
     *
     * @var array
     */
    private static $paths = [
        'theme'     => APPPATH . 'themes.%s.views.%s',
        'module'    => APPPATH . 'modules.%s.views.%s',
        'admin'     => APPPATH . 'views.admin.%s'
    ];

    /**
     * Render the given template.
     *
     * @param  string $path
     * @param  array  $data
     *
     * @return Response
     */
    public static function render(string $path, array $data = []) : Response
    {
        $view = new View();

        return $view->render(
            self::resolveTemplatePath($view, $path, $data), $data
        );
    }

    /**
     * Resolve the correct template path.
     *
     * @param  View   $view
     * @param  string $path
     * @param  array  $data
     *
     * @return string
     */
    private static function resolveTemplatePath(View $view, string $path, array $data) : string
    {
        $template = '';

        // If the requested template has the admin variable set,
        // we let the view package handle it.
        if (isset($data['admin']) && $data['admin']) {
            return sprintf(self::$paths['admin'], $path);
        }

        $theme  = sprintf(self::$paths['theme'], Config::get('theme', 'default'), $path);
        $module = sprintf(self::$paths['module'], Router::getActiveModule(), $path);

        // Try to resolve the view path. The theme should be preferred
        // over the module template, so themes can overwrite modules.
        if ($view->exists($theme)) {
            $template = $theme;
        } elseif ($view->exists($module)) {
            $template = $module;
        } else {
            throw new ViewNotFoundException($path);
        }

        return $template;
    }
}
