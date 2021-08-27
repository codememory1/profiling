<?php

namespace Codememory\Components\Profiling;

use Codememory\Components\Profiling\Exceptions\SectionExistException;
use Codememory\Components\Profiling\Exceptions\SectionNotExistException;
use Codememory\Components\Profiling\Interfaces\SectionInterface;

/**
 * Class ProfilerSection
 *
 * @package Codememory\Components\Profiling
 *
 * @author  Codememory
 */
class ProfilerSection
{

    /**
     * @var array
     */
    private static array $sections = [];

    /**
     * @param SectionInterface $section
     *
     * @return ProfilerSection
     * @throws SectionExistException
     */
    public static function addSection(SectionInterface $section): ProfilerSection
    {

        if (array_key_exists($section->getSectionName(), self::$sections)) {
            throw new SectionExistException($section->getSectionName());
        }

        self::$sections[$section->getSectionName()]['section'] = $section;

        return new self();

    }

    /**
     * @param string           $forSectionName
     * @param SectionInterface $subsection
     *
     * @return ProfilerSection
     * @throws SectionNotExistException
     */
    public static function addSubSection(string $forSectionName, SectionInterface $subsection): ProfilerSection
    {

        if (!array_key_exists($forSectionName, self::$sections)) {
            throw new SectionNotExistException($forSectionName);
        }

        self::$sections[$forSectionName]['subsections'][] = $subsection;

        return new self();

    }

    /**
     * @param string $sectionName
     *
     * @return array
     */
    public static function getSection(string $sectionName): array
    {

        return self::$sections[$sectionName];

    }

    /**
     * @return array
     */
    public static function getSections(): array
    {

        return self::$sections;

    }

}