<?php

namespace Codememory\Components\Profiling\ReportCreators;

use Codememory\Components\Profiling\Exceptions\BuilderNotCurrentSectionException;
use Codememory\Components\Profiling\Profiler;
use Codememory\Components\Profiling\Sections\Builders\LoggingBuilder;
use Codememory\Support\Arr;

/**
 * Class LoggingReportCreator
 *
 * @package Codememory\Components\Profiling\ReportCreators
 *
 * @author  Codememory
 */
final class LoggingReportCreator extends AbstractReportCreator
{

    /**
     * @inheritDoc
     * @throws BuilderNotCurrentSectionException
     */
    public function create(object $builder): void
    {

        $this->instanceofBuilder($builder, LoggingBuilder::class);

        parent::create($builder);

    }

    /**
     * @inheritDoc
     */
    public function get(?string $url = null): array
    {

        $url = $url ?: Profiler::getActivatedStatistic();
        $cache = $this->profilerCache->get();

        if ($this->isValidatedRoute()) {
            $logging = Arr::set($cache)::get(sprintf('%s.%s', urldecode($url), $this->section::class)) ?: [];

            foreach ($logging as &$data) {
                $data = (new LoggingBuilder())
                    ->setDemanded($data['demanded-class'], $data['demanded-method'])
                    ->setLevel($data['level'])
                    ->setMessage($data['message'])
                    ->setContext($data['context'])
                    ->setCreated($data['created']);
            }

            return $logging;
        }

        return [];

    }

    /**
     * @inheritDoc
     */
    protected function createReport(object $builder): void
    {

        $this->profilerCache->change(function (mixed &$data) use ($builder) {
            $data[$this->getRoutePath()][$this->section::class][] = [
                'demanded-class'  => $builder->getDemandedClass(),
                'demanded-method' => $builder->getDemandedMethod(),
                'level'           => $builder->getLevel(),
                'message'         => $builder->getMessage(),
                'context'         => $builder->getContext(),
                'created'         => $builder->getCreated(),
            ];
        });

    }

}