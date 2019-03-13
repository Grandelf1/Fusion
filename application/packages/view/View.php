<?php

namespace App\Packages\View;

use App\Packages\View\Engines\Engine;
use App\Packages\View\Engines\EngineFactory;
use App\Packages\Http\Response;
use Illuminate\Filesystem\Filesystem;
use App\Packages\View\Exceptions\ViewNotFoundException;

/**
 * Class View
 *
 * @package App\Packages\View;
 */
class View
{

    /**
     * The Illuminate filesystem class.
     *
     * @var Filesystem
     */
    private $files;

    /**
     * The Engine Factory instance.
     *
     * @var EngineFactory
     */
    private $engineFactory;

    /**
     * View constructor
     */
    public function __construct()
    {
        $this->files         = new Filesystem();
        $this->engineFactory = new EngineFactory();
    }

    /**
     * Render the given view.
     *
     * @param  string $path
     * @param  array  $data
     *
     * @return Response
     */
    public function render(string $path, array $data = []) : Response
    {
        if (!$file = $this->find($path)) {
            throw new ViewNotFoundException($path);
        }

        $engine = $this->resolveEngine($file);

        // Create the response that will render the view.
        return Response::make($engine->get($file));
    }

    /**
     * Determine if a given view exists.
     *
     * @param  string  $path
     *
     * @return bool
     */
    public function exists(string $path) : bool
    {
        return $this->find($path) !== null;
    }

    /**
     * Find the correct file path for the given view.
     *
     * @return string|null
     */
    public function find(string $path) : ?string
    {
        foreach ($this->getPossibleViewFiles($path) as $file) {
            if ($this->files->exists($file)) {
                return $file;
            }
        }

        return null;
    }

    /**
     * Get an array of possible view files.
     *
     * @param  string  $name
     *
     * @return array
     */
    private function getPossibleViewFiles(string $path)
    {
        return array_map(function ($extension) use ($path) {
            return str_replace('.', '/', $path).'.'.$extension;
        }, $this->getSupportedExtensions());
    }

    /**
     * Resolve the correct engine for the given path.
     *
     * @param  string
     *
     * @return Engine
     */
    private function resolveEngine(string $path) : Engine
    {
        return $this->engineFactory->make($path);
    }

    /**
     * Get all supported extensions.
     * TODO: Refactor instantiation of EngineFactory.
     *
     * @return array
     */
    private function getSupportedExtensions() : array
    {
        return $this->engineFactory->getExtensions();
    }
}
