<?php

namespace Codememory\Components\Profiling\ReportCreators;

use Codememory\Components\Profiling\Exceptions\BuilderNotCurrentSectionException;
use Codememory\Components\Profiling\Sections\Builders\HomeBuilder;
use Codememory\Support\Arr;

/**
 * Class HomeReportCreator
 *
 * @package Codememory\Components\Profiling\ReportCreators
 *
 * @author  Codememory
 */
final class HomeReportCreator extends AbstractReportCreator
{

    /**
     * @inheritDoc
     * @throws BuilderNotCurrentSectionException
     */
    public function create(object $builder): void
    {

        $this->instanceofBuilder($builder, HomeBuilder::class);

        parent::create($builder);

    }

    /**
     * @inheritDoc
     */
    public function get(?string $url = null): array
    {

        $url = $url ?: $this->getRoutePath();
        $cache = $this->profilerCache->get();

        if ($this->isValidatedRoute()) {
            $profiledPages = Arr::set($cache)::get(sprintf('%s.%s', $url, $this->section::class)) ?: [];

            foreach ($profiledPages as &$profiledPage) {
                $profiledPage = (new HomeBuilder())
                    ->setRoutePath($profiledPage['route'])
                    ->setHttpMethod($profiledPage['http-method'])
                    ->setController($profiledPage['controller'])
                    ->setControllerMethod($profiledPage['controller-method'])
                    ->setCreateDate($profiledPage['created']);
            }

            return $profiledPages;
        }

        return [];

    }

    /**
     * @inheritDoc
     */
    protected function createReport(object $builder): void
    {

        $this->profilerCache->change(function (mixed &$data) use ($builder) {
            if (!array_key_exists($builder->getRoutePath(), $data)) {
                $data[$builder->getRoutePath()][$this->section::class] = [
                    'route'             => $builder->getRoutePath(),
                    'http-method'       => $builder->getHttpMethod(),
                    'controller'        => $builder->getController(),
                    'controller-method' => $builder->getControllerMethod(),
                    'created'           => $this->dateTime->format('Y-m-d H:i:s')
                ];
            }
        });

    }

}