<?php

namespace Codememory\Components\Profiling\Exceptions;

use JetBrains\PhpStorm\Pure;

/**
 * Class BuilderNotCurrentSectionException
 *
 * @package Codememory\Components\Profiling\Exceptions
 *
 * @author  Codememory
 */
class BuilderNotCurrentSectionException extends AbstractProfilerException
{

    /**
     * @param string $section
     * @param string $builder
     */
    #[Pure]
    public function __construct(string $section, string $builder)
    {

        parent::__construct(sprintf('The %s section should host the %s', $section, $builder));

    }

}