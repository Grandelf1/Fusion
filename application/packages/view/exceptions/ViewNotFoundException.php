<?php

namespace App\Packages\View\Exceptions;

use RuntimeException;
use Throwable;

/**
 * Class ViewNotFoundException
 *
 * @package App\Packages\View\Exceptions
 */
class ViewNotFoundException extends RuntimeException
{

    /**
     * ViewNotFoundException constructor.
     *
     * @param string $template
     * @param string $entity
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        string $template,
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($this->message($template), $code, $previous);
    }

    /**
     * Generate the correct error message.
     *
     * @param string $template
     * @param string $entity
     *
     * @return string
     */
    private function message(string $template)
    {
        return 'Template '.$template.' not found.';
    }
}
