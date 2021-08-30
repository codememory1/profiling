<?php

namespace Codememory\Components\Profiling\Interfaces;

/**
 * Interface ProfilerInterface
 *
 * @package Codememory\Components\Profiling\Interfaces
 *
 * @author  Codememory
 */
interface ProfilerInterface
{

    /**
     * @param SectionInterface $section
     *
     * @return ProfilerInterface
     */
    public static function addSection(SectionInterface $section): ProfilerInterface;

}