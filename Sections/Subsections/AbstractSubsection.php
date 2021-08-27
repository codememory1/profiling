<?php

namespace Codememory\Components\Profiling\Sections\Subsections;

use Codememory\Components\Profiling\Sections\AbstractSection;
use Codememory\Support\Str;
use JetBrains\PhpStorm\Pure;

/**
 * Class AbstractSubsection
 *
 * @package Codememory\Components\Profiling\Sections\Subsections
 *
 * @author  Codememory
 */
abstract class AbstractSubsection extends AbstractSection
{

    /**
     * @return string
     */
    public function generateRoutePath(): string
    {

        $sectionName = Str::snakeCase($this->getSectionName());

        return sprintf('profiler-subsection=%s', Str::toLowercase($sectionName));

    }

}