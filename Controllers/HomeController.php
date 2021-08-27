<?php

namespace Codememory\Components\Profiling\Controllers;

use Codememory\Components\DateTime\Exceptions\InvalidTimezoneException;
use Codememory\Components\DateTime\Time;
use Codememory\Components\Profiling\Preserver;
use Codememory\Components\Profiling\ProfilerCache;
use Codememory\Components\Profiling\Sections\HomeSection;
use Codememory\HttpFoundation\Request\Request;
use Codememory\HttpFoundation\Response\RedirectResponse;
use Codememory\Support\Str;
use JetBrains\PhpStorm\Pure;

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
     * @param Time $time
     *
     * @return void
     * @throws InvalidTimezoneException
     */
    public function main(Time $time): void
    {

        $this->templateRender(new HomeSection(), [
            'profiledPages'   => Preserver::getProfiledPages(),
            'now-time'        => $time->now(),
            'httpMethodClass' => function (string $method): string {
                return $this->getHttpMethodClass($method);
            }
        ]);

    }

    /**
     * @param ProfilerCache $profilerCache
     * @param Request       $request
     *
     * @return void
     */
    public function removeAll(ProfilerCache $profilerCache, Request $request): void
    {

        $profilerCache->removeAllStatistic();

        $redirectResponse = new RedirectResponse($request);

        $redirectResponse->previous();

    }

    /**
     * @param string $method
     *
     * @return string
     */
    #[Pure]
    private function getHttpMethodClass(string $method): string
    {

        return match (Str::toUppercase($method)) {
            'POST', 'DELETE' => 'red',
            'GET' => 'green',
            'HEAD' => 'orange',
            default => 'blue'
        };

    }

}