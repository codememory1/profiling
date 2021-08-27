<?php

namespace Codememory\Components\Profiling\Controllers;

use Codememory\Components\Profiling\Preserver;
use Codememory\Components\Profiling\Sections\EventSection;

/**
 * Class EventsController
 *
 * @package Codememory\Components\Profiling\Controllers
 *
 * @author  Codememory
 */
class EventsController extends AbstractProfilerController
{

    /**
     * @param EventSection $section
     *
     * @return void
     */
    public function main(EventSection $section): void
    {

        $this->templateRender($section, [
            'events' => Preserver::getReport($section)
        ]);

    }

}