<?php

namespace Codememory\Components\Profiling\Controllers;

use Codememory\Components\Profiling\Exceptions\SectionNotImplementInterfaceException;
use Codememory\Components\Profiling\ReportCreators\EventsReportCreator;
use Codememory\Components\Profiling\Resource;
use Codememory\Components\Profiling\Sections\Builders\EventsBuilder;
use Codememory\Components\Profiling\Sections\EventsSection;
use Codememory\Routing\Router;
use ReflectionException;

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
     * @return void
     * @throws SectionNotImplementInterfaceException
     * @throws ReflectionException
     */
    public function index(): void
    {

        $eventsReportCreator = new EventsReportCreator(Router::getCurrentRoute(), new EventsSection(new Resource()));

        $events = $this->sortByDate($eventsReportCreator->get());

        $this->templateRender(EventsSection::class, [
            'events' => $events
        ]);

    }

    /**
     * @param array $logs
     *
     * @return array
     */
    private function sortByDate(array $logs): array
    {

        uasort($logs, function (EventsBuilder $one, EventsBuilder $two) {
            if ($one->getCompleted() === $two->getCompleted()) {
                return 0;
            }

            return $one->getCompleted() < $two->getCompleted() ? 1 : -1;
        });

        return $logs;

    }

}