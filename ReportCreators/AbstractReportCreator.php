<?php

namespace Codememory\Components\Profiling\ReportCreators;

use Codememory\Components\Profiling\Exceptions\BuilderNotCurrentSectionException;
use Codememory\Components\Profiling\Interfaces\BuilderInterface;
use Codememory\Components\Profiling\Interfaces\ReportCreatorInterface;
use Codememory\Components\Profiling\Interfaces\SectionInterface;
use Codememory\Components\Profiling\ProfilerCache;
use Codememory\Components\Profiling\Utils;
use Codememory\Routing\Route;
use ReflectionClass;

/**
 * Class AbstractReportCreator
 *
 * @package Codememory\Components\Profiling\ReportCreators
 *
 * @author  Codememory
 */
abstract class AbstractReportCreator implements ReportCreatorInterface
{

    /**
     * @var Route|null
     */
    protected ?Route $route;

    /**
     * @var SectionInterface
     */
    protected SectionInterface $section;

    /**
     * @var Utils
     */
    protected Utils $utils;

    /**
     * @var ProfilerCache
     */
    protected ProfilerCache $profilerCache;

    /**
     * @param Route|null       $route
     * @param SectionInterface $section
     */
    public function __construct(?Route $route, SectionInterface $section)
    {

        $this->route = $route;
        $this->section = $section;
        $this->utils = new Utils();
        $this->profilerCache = new ProfilerCache();

    }

    /**
     * @inheritDoc
     */
    public function create(object $builder): void
    {

        $this->isValidatedRoute(function () use ($builder) {
            $this->createReport($builder);
        });

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the path of the currently open route
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return string|null
     */
    protected function getRoutePath(): ?string
    {

        if ($this->isValidatedRoute()) {
            return $this->route->getResources()->getPathGenerator()->getPath();
        }

        return null;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Executes a callback if the current route is valid, also returns a bool value
     * indicating the validation of the current route
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param callable|null $callback
     *
     * @return bool
     */
    protected function isValidatedRoute(?callable $callback = null): bool
    {

        if (null !== $this->route) {
            if (null !== $callback) {
                call_user_func($callback);
            }

            return true;
        }

        return false;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Checks the correctness of the passed builder
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param object $builder
     * @param string $shouldBeBuilder
     *
     * @throws BuilderNotCurrentSectionException
     */
    protected function instanceofBuilder(object $builder, string $shouldBeBuilder): void
    {

        $reflector = new ReflectionClass($builder);

        if (!$reflector->implementsInterface(BuilderInterface::class) || !$builder instanceof $shouldBeBuilder) {
            throw new BuilderNotCurrentSectionException(static::class, $shouldBeBuilder);
        }

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * This method creates just one report
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param object $builder
     *
     * @return void
     */
    abstract protected function createReport(object $builder): void;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * The main handler for creating a report, with checks per page - whether
     * it needs to be profiled
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param object $builder
     *
     * @return void
     */
    protected function handleCreateReport(object $builder): void
    {

        if ([] === $this->utils->profilingPages()) {
            $this->createReport($builder);
        } else {
            foreach ($this->utils->profilingPages() as $profilingPage) {
                if ($profilingPage === $this->getRoutePath()) {
                    $this->createReport($builder);
                }
            }
        }

    }

}