<?php

namespace Codememory\Components\Profiling\ReportCreators;

use Codememory\Components\DateTime\DateTime;
use Codememory\Components\DateTime\Exceptions\InvalidTimezoneException;
use Codememory\Components\Profiling\Exceptions\BuilderNotCurrentSectionException;
use Codememory\Components\Profiling\Profiler;
use Codememory\Components\Profiling\Sections\Builders\EventsBuilder;
use Codememory\Support\Arr;

/**
 * Class EventsReportCreator
 *
 * @package Codememory\Components\Profiling\ReportCreators
 *
 * @author  Codememory
 */
final class EventsReportCreator extends AbstractReportCreator
{

    /**
     * @inheritDoc
     * @throws BuilderNotCurrentSectionException
     */
    public function create(object $builder): void
    {

        $this->instanceofBuilder($builder, EventsBuilder::class);

        parent::create($builder);

    }

    /**
     * @inheritDoc
     */
    protected function createReport(object $builder): void
    {

        /** @var EventsBuilder $builder */
        $this->profilerCache->change(function (mixed &$data) use ($builder) {
            $data[$this->getRoutePath()][$this->section::class][] = [
                'event'           => $builder->getEvent(),
                'listeners'       => $builder->getListeners(),
                'demanded-class'  => $builder->getDemandedClass(),
                'demanded-method' => $builder->getDemandedMethod(),
                'competed'        => $builder->getCompleted(),
                'lead-time'       => $builder->getLeadTime(),
            ];
        });

    }

    /**
     * @inheritDoc
     * @throws InvalidTimezoneException
     */
    public function get(?string $url = null): array
    {

        $url = $url ?: Profiler::getActivatedStatistic();
        $cache = $this->profilerCache->get();

        if ($this->isValidatedRoute()) {
            $logging = Arr::set($cache)::get(sprintf('%s.%s', urldecode($url), $this->section::class)) ?: [];

            foreach ($logging as &$data) {
                $data = (new EventsBuilder())
                    ->setEvent($data['event'])
                    ->setListeners($data['listeners'])
                    ->setDemanded($data['demanded-class'], $data['demanded-method'])
                    ->setCompleted($this->dateTime->format('Y-m-d H:i:s'))
                    ->setLeadTime($data['lead-time']);
            }

            return $logging;
        }

        return [];

    }

}