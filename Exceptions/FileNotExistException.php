<?php

namespace Codememory\Components\Profiling\Exceptions;

use JetBrains\PhpStorm\Pure;

/**
 * Class FileNotExistException
 *
 * @package Codememory\Components\Profiling\Exceptions
 *
 * @author  Codememory
 */
class FileNotExistException extends AbstractResourceException
{

    /**
     * @param string $path
     */
    #[Pure]
    public function __construct(string $path)
    {

        parent::__construct(sprintf('The resource on path %s does not exist', $path));

    }

}