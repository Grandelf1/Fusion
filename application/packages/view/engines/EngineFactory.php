<?php

namespace App\Packages\View\Engines;

use Exception;

/**
 * Class EngineFactory
 *
 * @package App\Packages\View\Engines
 */
class EngineFactory
{

    /**
     * The supported extensions.
     *
     * @var array
     */
    private $extensions = [
        'tpl' => SmartyEngine::class
    ];

    /**
     * Get a template engine instance.
     *
     * @param  string $path
     *
     * @return Engine
     */
    public function make(string $path) : Engine
    {
        return $this->instance(
            $this->getEngineFromPath($path)
        );
    }

    /**
     * Get all supported extensions.
     *
     * @return array
     */
    public function getExtensions() : array
    {
        return array_keys($this->extensions);
    }

    /**
     * Get the correct engine class name for the given path.
     * Valid engines are listed in the extensions array.
     *
     * @param  string $path
     *
     * @return string
     */
    private function getEngineFromPath(string $path) : string
    {
        if (!$extension = $this->getExtension($path)) {
            throw new Exception('Unsupported template: ' . $path);
        }

        return $this->getEngineByExtension($extension);
    }

    /**
     * Find the extension in the file path and match it against
     * the registered file extensions.
     *
     * @param  string $path
     *
     * @return array|null
     */
    private function getExtension(string $path) : ?string
    {
        $extensions = $this->getExtensions();

        // Loop through all extensions and reject those that aren't
        // registered in the extensions array.
        $extension  = array_filter($extensions, function($extension) use ($path) {
            return (substr($path, -strlen('.'.$extension)) === '.'.$extension);
        });

        return $extension[0] ?? null;
    }

    /**
     * Get the engine class name by extension (key).
     *
     * @param  string $extension
     *
     * @return string|null
     */
    private function getEngineByExtension(string $extension) : ?string
    {
        return $this->extensions[$extension] ?? null;
    }

    /**
     * Instantiate the engine.
     *
     * @param  string $engine
     *
     * @return Engine
     */
    private function instance(string $engine) : Engine
    {
        return new $engine;
    }
}
