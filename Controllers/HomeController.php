<?php

namespace Codememory\Components\Profiling\Controllers;

use Codememory\Components\DateTime\Exceptions\InvalidTimezoneException;
use Codememory\Components\DateTime\Time;
use Codememory\Components\Profiling\Exceptions\SectionNotImplementInterfaceException;
use Codememory\Components\Profiling\Profiler;
use Codememory\Components\Profiling\ProfilerCache;
use Codememory\Components\Profiling\Sections\HomeSection;
use Codememory\HttpFoundation\Request\Request;
use Codememory\HttpFoundation\Response\RedirectResponse;
use Codememory\Support\Str;
use JetBrains\PhpStorm\Pure;
use ReflectionException;

/**
 * Class HomeController
 *
 * @package Codememory\Components\Profiling\Controllers
 *
 * @author  Codememory
 */
class HomeController extends AbstractProfilerController
{

    /**
     * @return void
     * @throws ReflectionException
     * @throws SectionNotImplementInterfaceException
     * @throws InvalidTimezoneException
     */
    public function index(): void
    {

        $profilerCache = new ProfilerCache();
        $time = new Time();

        $profiledPages = [];

        foreach ($profilerCache->get() as $dataSections) {
            $profiledPages[] = $dataSections[HomeSection::class];
        }

        $this->templateRender(HomeSection::class, [
            'profiledPages'     => $profiledPages,
            'now-time'          => $time->now(),
            'http-method-class' => $this->getHttpMethodClass()
        ]);

    }

    /**
     * @param Request $request
     *
     * @return void
     */
    public function removeStatistics(Request $request): void
    {

        (new ProfilerCache())->remove();

        (new RedirectResponse($request))->previous();

    }

    /**
     * @return callable
     */
    #[Pure]
    private function getHttpMethodClass(): callable
    {

        return function ($method) {
            return match (Str::toUppercase($method)) {
                'POST', 'DELETE' => 'red',
                'GET' => 'green',
                'HEAD' => 'orange',
                default => 'blue'
            };
        };

    }

}