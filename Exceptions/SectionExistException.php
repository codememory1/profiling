<?php

namespace Codememory\Components\Profiling\Exceptions;

use JetBrains\PhpStorm\Pure;

/**
 * Class SectionExistException
 *
 * @package Codememory\Components\Profiling\Exceptions
 *
 * @author  Codememory
 */
class SectionExistException extends AbstractSectionException
{

    /**
     * @param string $sectionName
     */
    #[Pure]
    public function __construct(string $sectionName)
    {

        parent::__construct(sprintf('A section named %s has already been added', $sectionName));

    }

}