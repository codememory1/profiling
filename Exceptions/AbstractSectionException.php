<?php

namespace Codememory\Components\Profiling\Exceptions;

use ErrorException;
use JetBrains\PhpStorm\Pure;

/**
 * Class AbstractSectionException
 *
 * @package Codememory\Components\Profiling\Exceptions
 *
 * @author  Codememory
 */
abstract class AbstractSectionException extends ErrorException
{

    /**
     * @param string|null $message
     */
    #[Pure]
    public function __construct(string $message = null)
    {

        parent::__construct($message);

    }

}