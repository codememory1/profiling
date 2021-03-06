<?php

namespace Codememory\Components\Profiling;

use Codememory\Components\Profiling\Controllers\HomeController;
use Codememory\Components\Profiling\ErrorHandler\ErrorHandler;
use Codememory\Components\Profiling\Interfaces\ProfilerInterface;
use Codememory\Components\Profiling\Interfaces\SectionInterface;
use Codememory\Components\Profiling\Sections\DatabaseSection;
use Codememory\Components\Profiling\Sections\EventsSection;
use Codememory\Components\Profiling\Sections\HomeSection;
use Codememory\Components\Profiling\Sections\LoggingSection;
use Codememory\Components\Profiling\Sections\PerformanceSection;
use Codememory\Components\Profiling\Sections\Subsections\PerformanceReportResultSection;
use Codememory\HttpFoundation\Request\Request;
use Codememory\Routing\Router;

/**
 * Class Profiler
 *
 * @package Codememory\Components\Profiling
 *
 * @author  Codememory
 */
class Profiler implements ProfilerInterface
{

    public const ROUTE_NAME_PREFIX = '__cdm-profiler_';
    public const STATISTIC_COOKIE_KEY = '__cdm-profiler-statistic';

    /**
     * @var array
     */
    private static array $sections = [];

    /**
     * @var bool
     */
    private static bool $isInit = false;
    
    /**
     * @var array
     */
    private static array $hiddenSections = [];

    /**
     * @var Utils|null
     */
    private static ?Utils $utils = null;

    /**
     * @var Request|null
     */
    private static ?Request $request = null;

    /**
     * @var float|null
     */
    private static ?float $unixTime = null;

    /**
     * @inheritDoc
     */
    public static function addSection(SectionInterface $section): ProfilerInterface
    {

        self::$sections[] = $section;

        return new self();

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Profiler initialization. The method should be called only once and at
     * the beginning of the project
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return void
     */
    public static function init(): void
    {

        self::$isInit = true;
        
        (new ErrorHandler())->modeHandler();

        self::$unixTime = $_SERVER['REQUEST_TIME_FLOAT'] ?? microtime(true);
        self::$utils = new Utils();
        self::$request = new Request();

        self::executeWhenProfilerIsEnabled(function () {
            self::addingReservedSections();
            self::initRoutes();
        });

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns an array of objects of all sections of the profiler
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return array
     */
    public static function getSections(): array
    {

        return self::$sections;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Run xhprof(profiling) code based on profiler configuration
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return void
     */
    public static function xhprofStart(): void
    {

        self::executeWhenProfilerIsEnabled(function () {
            xhprof_enable(XHPROF_FLAGS_MEMORY | XHPROF_FLAGS_MEMORY | XHPROF_FLAGS_CPU);
        });

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the result of profiling code using xhprof
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return array
     */
    public static function getXhprofData(): array
    {

        return self::executeWhenProfilerIsEnabled(function () {
            return xhprof_disable() ?: [];
        }) ?: [];

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns a boolean value indicating the initialization of the profiler
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return bool
     */
    public static function isInit(): bool
    {

        return self::$isInit;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Adding reserved sections
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return void
     */
    private static function addingReservedSections(): void
    {

        $resource = new Resource();

        self::$hiddenSections[] = new PerformanceReportResultSection($resource);

        self::$sections[] = new HomeSection($resource);
        self::$sections[] = new PerformanceSection($resource);
        self::$sections[] = new LoggingSection($resource);
        self::$sections[] = new EventsSection($resource);
        self::$sections[] = new DatabaseSection($resource);

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Initializing all section routes
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return void
     */
    private static function initRoutes(): void
    {

        Router::subdomainGroup(self::$utils->profilerSubdomain(), function () {
            foreach (self::$hiddenSections as $hiddenSection) {
                self::routeCreation($hiddenSection);
            }

            foreach (self::$sections as $section) {
                self::routeCreation($section);

                if ([[] !== $section->getSubsections()]) {
                    foreach ($section->getSubsections() as $subsection) {
                        self::routeCreation($subsection);
                    }
                }
            }

            Router::get('/remove-statistic', [HomeController::class, 'removeStatistics'])->name('__cdm-profiler-remove-statistic');
        });

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Creating a route from a section
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param SectionInterface $section
     */
    private static function routeCreation(SectionInterface $section): void
    {
        
        $name = sprintf('%s%s', self::ROUTE_NAME_PREFIX, $section::class);

        Router::get($section->getRoutePath(), [$section->getController(), $section->getControllerMethod()])->name($name);

    }

    /**
     * @return float|null
     */
    public static function getUnixTime(): ?float
    {

        return self::$unixTime;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns url of activated statistics
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return string|null
     */
    public static function getActivatedStatistic(): ?string
    {

        return urldecode(self::$request->cookie->get(self::STATISTIC_COOKIE_KEY) ?: '');

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the section object by namespace if the section was registered
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $namespace
     *
     * @return SectionInterface|null
     */
    public static function getSection(string $namespace): ?SectionInterface
    {

        foreach (self::$sections as $section) {
            if ($section instanceof $namespace) {
                return $section;
            }
        }

        return null;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Callback if profiler is enabled
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param callable $callback
     *
     * @return void
     */
    public static function executeWhenProfilerIsEnabled(callable $callback): mixed
    {

        if ((self::$utils->isDev() && self::$utils->enabledProfiler())
            || self::$utils->enabledProfilerInProduction()) {
            return call_user_func($callback);
        }

        return null;

    }

}