<?php

namespace Codememory\Components\Profiling\ReportCreators;

use Codememory\Components\Profiling\Exceptions\BuilderNotCurrentSectionException;
use Codememory\Components\Profiling\Profiler;
use Codememory\Components\Profiling\Sections\Builders\DatabaseBuilder;
use Codememory\Support\Arr;

/**
 * Class DatabaseReportCreator
 *
 * @package Codememory\Components\Profiling\ReportCreators
 *
 * @author  Codememory
 */
class DatabaseReportCreator extends AbstractReportCreator
{

    /**
     * @inheritDoc
     * @throws BuilderNotCurrentSectionException
     */
    public function create(object $builder): void
    {

        $this->instanceofBuilder($builder, DatabaseBuilder::class);

        parent::create($builder);

    }

    /**
     * @inheritDoc
     */
    protected function createReport(object $builder): void
    {

        /** @var DatabaseBuilder $builder */
        $this->profilerCache->change(function (mixed &$data) use ($builder) {
            $data[$this->getRoutePath()][$this->section::class][] = [
                'repository' => $builder->getRepository(),
                'connector'  => $builder->getConnector(),
                'query'      => $builder->getQuery(),
                'duration'   => $builder->getDuration(),
                'created_at' => $this->dateTime->format('Y-m-d H:i:s')
            ];
        });

    }

    /**
     * @inheritDoc
     */
    public function get(?string $url = null): array
    {

        $url = $url ?: Profiler::getActivatedStatistic();
        $cache = $this->profilerCache->get();

        if ($this->isValidatedRoute()) {
            $profiledPages = Arr::set($cache)::get(sprintf('%s.%s', $url, $this->section::class)) ?: [];

            foreach ($profiledPages as &$profiledPage) {
                $profiledPage = (new DatabaseBuilder())
                    ->setRepository($profiledPage['repository'])
                    ->setConnector($profiledPage['connector'])
                    ->setQuery($profiledPage['query'])
                    ->setDuration($profiledPage['duration'])
                    ->setCreatedAt($profiledPage['created_at']);
            }

            return $profiledPages;
        }

        return [];

    }

}