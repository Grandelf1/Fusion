<?php

namespace App\Packages\Http;

use App\Packages\Ci\CI;
use CI_Output;

/**
 * Class Response
 *
 * @package App\Packages\Http
 */
class Response
{

    /**
     * The Code Igniter output component.
     *
     * @var CI_Output
     */
    private $output;

    /**
     * Response constructor
     *
     * @param  string $content
     * @param  int    $status
     */
    public function __construct(string $content = '', int $status = 200)
    {
        $this->output = CI::get('output');

        $this->output->set_output($content);
        $this->output->set_status_header($status);
    }

    /**
     * Set a header on the response.
     *
     * @param  string $name
     * @param  string $value
     * @param  bool   $replace
     *
     * @return Response
     */
    public function header(string $name, string $value, bool $replace = true)
    {
        $this->output->set_header($name.':'.$value, $replace);

        return $this;
    }

    /**
     * Set the content of the response.
     *
     * @param  string $content
     *
     * @return Response
     */
    public function content(string $content)
    {
        $this->output->set_output($content);

        return $this;
    }

    /**
     * Set the status code of the response.
     *
     * @param  int $status
     *
     * @return Response
     */
    public function status(int $status)
    {
        $this->output->set_status_header($status);

        return $this;
    }

    /**
     * Get the content of the response.
     *
     * @return string|null
     */
    public function getContent() : ?string
    {
        return $this->output->get_output();
    }

    /**
     * Check if the response has the given header.
     *
     * @param  string $header
     *
     * @return bool
     */
    public function hasHeader(string $header) : bool
    {
        return !is_null($this->output->get_header($header));
    }

    /**
     * Get the value for the given header.
     *
     * @param  string $header
     *
     * @return string|null
     */
    public function getHeader(string $header) : ?string
    {
        return $this->output->get_header($header);
    }

    /**
     * Static wrapper to create a response.
     *
     * @param  string $content
     * @param  int    $status
     *
     * @return Response
     */
    public static function make(string $content = '', int $status = 200)
    {
        return new self($content, $status);
    }

    /**
     * Static wrapper to create a JSON response.
     *
     * @param  array $content
     * @param  int   $status
     *
     * @return Response
     */
    public static function json(array $content = [], int $status = 200)
    {
        return self::make(json_encode($content), $status)
            ->header('content-type', 'application/json');
    }
}
