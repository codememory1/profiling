<?php

namespace Codememory\Components\Profiling;

use Codememory\Components\Profiling\Interfaces\ProfilerCacheInterface;
use Codememory\Components\Profiling\Interfaces\SectionInterface;
use Codememory\Components\Profiling\Sections\HomeSection;
use Codememory\HttpFoundation\Request\Request;

/**
 * Class Preserver
 *
 * @package Codememory\Components\Profiling
 *
 * @author  Codememory
 */
class Preserver
{

    public const COOKIE_ACTIVATED_STATISTIC = '__cdm-profiler-statistic';

    /**
     * @var ProfilerCacheInterface|null
     */
    private static ?ProfilerCacheInterface $profilerCache = null;

    /**
     * @var Request|null
     */
    private static ?Request $request = null;

    /**
     * @return ProfilerCacheInterface
     */
    public static function getProfilerCache(): ProfilerCacheInterface
    {

        if (self::$profilerCache instanceof ProfilerCacheInterface) {
            return self::$profilerCache;
        }

        return self::$profilerCache = new ProfilerCache();

    }

    /**
     * @return Request
     */
    public static function getRequest(): Request
    {

        if (self::$request instanceof Request) {
            return self::$request;
        }

        return self::$request = new Request();

    }

    /**
     * @param SectionInterface $section
     * @param array            $report
     * @param bool             $add
     *
     * @return void
     */
    public static function saveReport(SectionInterface $section, array $report, bool $add = false): void
    {

        $request = self::getRequest();
        $url = $request->url->current();

        self::getProfilerCache()->add($request->url->removeParameters($url), $section->getSectionName(), $report, $add);

    }

    /**
     * @param SectionInterface $section
     *
     * @return array
     */
    public static function getReport(SectionInterface $section): array
    {

        $activatedStatistic = urldecode(self::getRequest()->cookie->get(self::COOKIE_ACTIVATED_STATISTIC));

        return self::getProfilerCache()->get($activatedStatistic, $section->getSectionName());

    }

    /**
     * @return array
     */
    public static function getProfiledPages(): array
    {

        $profiledPages = [];

        foreach (self::getProfilerCache()->getAll() as $profiledUrl => $data) {
            $profiledPageData = self::getProfilerCache()->get($profiledUrl, (new HomeSection())->getSectionName());

            if([] !== $profiledPageData) {
                $profiledPages[] = [
                    'route'            => $profiledUrl,
                    'method'           => $profiledPageData['method'],
                    'controller'       => $profiledPageData['controller'],
                    'controllerMethod' => $profiledPageData['controllerMethod'],
                    'created'          => $profiledPageData['created']
                ];
            }
        }

        return $profiledPages;

    }

}