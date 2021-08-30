<?php

namespace Codememory\Components\Profiling\ReportCreators;

use Codememory\Components\DateTime\DateTime;
use Codememory\Components\Profiling\Exceptions\BuilderNotCurrentSectionException;
use Codememory\Components\Profiling\Profiler;
use Codememory\Components\Profiling\Sections\Builders\PerformanceReportBuilder;
use Codememory\Support\Arr;

/**
 * Class PerformanceReportCreator
 *
 * @package Codememory\Components\Profiling\ReportCreators
 *
 * @author  Codememory
 */
final class PerformanceReportCreator extends AbstractReportCreator
{

    /**
     * @inheritDoc
     * @throws BuilderNotCurrentSectionException
     */
    public function create(object $builder): void
    {

        $this->instanceofBuilder($builder, PerformanceReportBuilder::class);

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
            $performance = Arr::set($cache)::get(sprintf('%s.%s', urldecode($url), $this->section::class)) ?: [];

            foreach ($performance as &$data) {
                $data = (new PerformanceReportBuilder())
                    ->setHash($data['hash'])
                    ->setLeadTime($data['lead-time'])
                    ->setReport($data['report'])
                    ->setCreated($data['created']);
            }

            return $performance;
        }

        return [];

    }

    protected function createReport(object $builder): void
    {

        /** @var PerformanceReportBuilder $builder */
        $this->profilerCache->change(function (mixed &$data) use ($builder) {
            $data[Profiler::getActivatedStatistic()][$this->section::class][] = [
                'hash'      => bin2hex(random_bytes(10)),
                'report'    => $builder->getReport(),
                'lead-time' => (Profiler::getUnixTime() - microtime(true)) / 1000,
                'created'   => (new DateTime())->format('Y-m-d H:i:s')
            ];
        });

    }


}