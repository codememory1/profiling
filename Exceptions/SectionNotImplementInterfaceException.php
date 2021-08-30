<?php

namespace Codememory\Components\Profiling\Exceptions;

use JetBrains\PhpStorm\Pure;

/**
 * Class SectionNotImplementInterfaceException
 *
 * @package Codememory\Components\Profiling\Exceptions
 *
 * @author  Codememory
 */
class SectionNotImplementInterfaceException extends AbstractProfilerException
{

    /**
     * @param string $section
     * @param string $interface
     */
    #[Pure]
    public function __construct(string $section, string $interface)
    {

        parent::__construct(sprintf(
            'The %s class must implement the %s interface to be a profiler section',
            $section,
            $interface
        ));

    }

}