<?php

namespace Codememory\Components\Profiling;

use Codememory\Components\Profiling\Interfaces\SectionInterface;
use Codememory\Components\Profiling\Sections\EventSection;
use Codememory\Components\Profiling\Sections\HomeSection;
use Codememory\Components\Profiling\Sections\LoggingSection;
use Codememory\Components\Profiling\Sections\PerformanceSection;
use Codememory\Components\Profiling\Sections\Subsections\ComparePerformanceReports;
use Codememory\Components\Profiling\Sections\Subsections\ListPerformanceReports;
use Codememory\Components\Profiling\Sections\Subsections\PerformanceReportsResult;
use Codememory\Routing\Router;
use ReflectionClass;

/**
 * Class Profiler
 *
 * @package Codememory\Components\Profiling
 *
 * @author  Codememory
 */
class Profiler
{

    /**
     * @var Utils
     */
    private static Utils $utils;

    /**
     * @return void
     */
    public static function enable(): void
    {

        self::$utils = new Utils();

    }

    /**
     * @return void
     */
    public static function enablePerformance(): void
    {

        if (isDev() || self::$utils->getEnabledInProd()) {
            xhprof_enable(XHPROF_FLAGS_CPU | XHPROF_FLAGS_MEMORY);
        }

    }

    /**
     * @return array
     */
    public static function getPerformanceReport(): array
    {

        if (isDev() || self::$utils->getEnabledInProd()) {
            return xhprof_disable();
        }

        return [];

    }

    /**
     * @return void
     * @throws Exceptions\SectionExistException
     * @throws Exceptions\SectionNotExistException
     */
    public static function initialization(): void
    {

        self::initReservedSections();
        self::initRoutes();

    }

    /**
     * @param SectionInterface $section
     *
     * @return string
     */
    public static function generateRouteName(SectionInterface $section): string
    {

        $reflector = new ReflectionClass($section);

        return sprintf('__profiler-%s', $reflector->getShortName());

    }

    /**
     * @return void
     * @throws Exceptions\SectionExistException
     * @throws Exceptions\SectionNotExistException
     */
    private static function initReservedSections(): void
    {

        $performanceSection = new PerformanceSection();

        ProfilerSection::addSection(new HomeSection());
        ProfilerSection::addSection($performanceSection);
        ProfilerSection::addSection(new LoggingSection());
        ProfilerSection::addSection(new EventSection());

        ProfilerSection::addSubSection($performanceSection->getSectionName(), new ListPerformanceReports());
        ProfilerSection::addSubSection($performanceSection->getSectionName(), new ComparePerformanceReports());

    }

    /**
     * @return void
     */
    private static function initRoutes(): void
    {

        if (isDev() || self::$utils->getEnabledInProd()) {
            Router::subdomainGroup(self::$utils->getSubdomain(), function () {
                foreach (ProfilerSection::getSections() as $sectionData) {
                    self::routeCreation($sectionData);
                }
            });

            self::routeCreation(['section' => new PerformanceReportsResult()]);

            Router::get('/remove-profiled-pages', 'Codememory\Components\Profiling\Controllers\HomeController#removeAll')->name('__profiler-remove-all-statistics');
        }

    }

    /**
     * @param array $sectionData
     *
     * @return void
     */
    private static function routeCreation(array $sectionData): void
    {

        $allSections = array_merge([$sectionData['section']], $sectionData['subsections'] ?? []);

        /** @var SectionInterface $section */
        foreach ($allSections as $section) {
            $action = sprintf('%s#%s', $section->getController(), $section->getControllerMethod());

            Router::get($section->generateRoutePath(), $action)->name(self::generateRouteName($section));
        }

    }

}