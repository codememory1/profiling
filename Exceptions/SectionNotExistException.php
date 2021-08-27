<?php

namespace Codememory\Components\Profiling\Exceptions;

use JetBrains\PhpStorm\Pure;

/**
 * Class SectionNotExistException
 *
 * @package Codememory\Components\Profiling\Exceptions
 *
 * @author  Codememory
 */
class SectionNotExistException extends AbstractSectionException
{

    /**
     * @param string $sectionName
     */
    #[Pure]
    public function __construct(string $sectionName)
    {

        parent::__construct(sprintf('The %s section does not exist', $sectionName));

    }

}