<?php

namespace Codememory\Components\Profiling\Exceptions;

use ErrorException;
use JetBrains\PhpStorm\Pure;

/**
 * Class AbstractProfilerException
 *
 * @package Codememory\Components\Profiling\Exceptions
 *
 * @author  Codememory
 */
abstract class AbstractProfilerException extends ErrorException
{

    /**
     * @param string|null $message
     */
    #[Pure]
    public function __construct(?string $message = null)
    {

        parent::__construct($message ?: '');

    }

}