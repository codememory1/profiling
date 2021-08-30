<?php

namespace Codememory\Components\Profiling\Sections;

use Codememory\Components\Profiling\Interfaces\ResourceInterface;
use Codememory\Components\Profiling\Interfaces\SectionInterface;
use Codememory\Components\Profiling\ProfilerCache;

/**
 * Class AbstractSection
 *
 * @package Codememory\Components\Profiling\Sections
 *
 * @author  Codememory
 */
abstract class AbstractSection implements SectionInterface
{

    /**
     * @var ResourceInterface
     */
    protected ResourceInterface $resource;

    /**
     * @var ProfilerCache
     */
    protected ProfilerCache $profilerCache;

    /**
     * @var string|null
     */
    protected ?string $routePath = null;

    /**
     * @var string|null
     */
    protected ?string $icon = null;

    /**
     * @var string|null
     */
    protected ?string $name = null;

    /**
     * @var array
     */
    protected array $subsections = [];

    /**
     * @var string|null
     */
    protected ?string $contentPath = null;

    /**
     * @var string|null
     */
    protected ?string $controller = null;

    /**
     * @var string|null
     */
    protected ?string $controllerMethod = null;

    /**
     * @param ResourceInterface $resource
     */
    public function __construct(ResourceInterface $resource)
    {

        $this->resource = $resource;
        $this->profilerCache = new ProfilerCache();

    }

    /**
     * @inheritDoc
     */
    public function getRoutePath(): ?string
    {

        return $this->routePath;

    }

    /**
     * @inheritDoc
     */
    public function getIcon(): ?string
    {

        return $this->icon;

    }

    /**
     * @inheritDoc
     */
    public function getName(): ?string
    {

        return $this->name;

    }

    /**
     * @inheritDoc
     */
    public function getContentPath(): ?string
    {

        return $this->resource->getPath($this->contentPath);

    }

    /**
     * @inheritDoc
     */
    final public function getSubsections(): array
    {

        $subsections = [];

        foreach ($this->subsections as $subsection) {
            if (class_exists($subsection)) {
                $subsections[] = new $subsection($this->resource);
            }
        }

        return $subsections;

    }

    /**
     * @inheritDoc
     */
    public function getController(): ?string
    {

        return $this->controller;

    }

    /**
     * @inheritDoc
     */
    public function getControllerMethod(): ?string
    {

        return $this->controllerMethod;

    }

}