<?php

namespace Codememory\Components\Profiling;

use Codememory\Components\Profiling\Exceptions\SectionNotImplementInterfaceException;
use Codememory\Components\Profiling\Interfaces\ResourceInterface;
use Codememory\Components\Profiling\Interfaces\SectionInterface;
use Codememory\Support\Arr;
use ReflectionClass;
use ReflectionException;

/**
 * Class TemplateRenderer
 *
 * @package Codememory\Components\Profiling
 *
 * @author  Codememory
 */
class TemplateRenderer
{

    private const DEFAULT_TEMPLATE = 'profiler.php';

    /**
     * @var ResourceInterface
     */
    private ResourceInterface $resource;

    /**
     * @var SectionInterface
     */
    private SectionInterface $section;

    /**
     * @var array
     */
    private array $parameters;

    /**
     * @var string
     */
    private string $templatePath;

    /**
     * @param string      $section
     * @param array       $parameters
     * @param string|null $template
     *
     * @throws ReflectionException
     * @throws SectionNotImplementInterfaceException
     */
    public function __construct(string $section, array $parameters = [], ?string $template = null)
    {

        $this->resource = new Resource();

        $reflectorSection = new ReflectionClass($section);

        if (!$reflectorSection->implementsInterface(SectionInterface::class)) {
            throw new SectionNotImplementInterfaceException($section, SectionInterface::class);
        }

        /** @var SectionInterface $sectionObject */
        $sectionObject = $reflectorSection->newInstance($this->resource);

        $this->section = $sectionObject;
        $this->parameters = $parameters;
        $this->templatePath = $template ?: $this->resource->getPath(self::DEFAULT_TEMPLATE);

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Includes the main profiler template
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return void
     */
    public function render(): void
    {

        require_once $this->templatePath;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Includes the content file of the section
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return void
     */
    public function contentRender(): void
    {

        require_once $this->section->getContentPath();

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns an object for working with resources
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return ResourceInterface
     */
    public function getResource(): ResourceInterface
    {

        return $this->resource;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns an array of all passed parameters to the template
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return array
     */
    public function getParameters(): array
    {

        return $this->parameters;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Get a specific parameter
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $keys
     *
     * @return mixed
     */
    public function getParameter(string $keys): mixed
    {

        return Arr::set($this->getParameters())::get($keys);

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the route path by section name
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $section
     * @param array  $parameters
     *
     * @return string
     */
    public function getRoutePath(string $section, array $parameters = []): string
    {

        return routePath(sprintf('%s%s', Profiler::ROUTE_NAME_PREFIX, $section), $parameters);

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Overrides the built-in number_format function, changing only the default arguments
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param float  $num
     * @param int    $decimals
     * @param string $decimalSeparator
     * @param string $thousandsSeparator
     *
     * @return string
     */
    public function overrideNumberFormat(float $num, int $decimals = 0, string $decimalSeparator = ',', string $thousandsSeparator = ''): string
    {

        return number_format($num, $decimals, $decimalSeparator, $thousandsSeparator);

    }

}