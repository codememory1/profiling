<?php

namespace Codememory\Components\Profiling\Sections;

use Codememory\Components\Profiling\Interfaces\SectionInterface;
use Codememory\Support\Str;
use JetBrains\PhpStorm\Pure;

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
     * @var string|null
     */
    protected ?string $icon = null;

    /**
     * @var string|null
     */
    protected ?string $sectionName = null;

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
     * @inheritdoc
     */
    public function generateRoutePath(): string
    {

        $sectionName = Str::snakeCase($this->getSectionName());

        return sprintf('profiler-section=%s', Str::toLowercase($sectionName));

    }

    /**
     * @inheritdoc
     */
    public function getIcon(): ?string
    {

        return $this->icon;

    }

    /**
     * @inheritdoc
     */
    public function getSectionName(): ?string
    {

        return $this->sectionName;

    }

    /**
     * @inheritdoc
     */
    public function getContentPath(): ?string
    {

        return $this->contentPath;

    }

    /**
     * @inheritdoc
     */
    public function getController(): ?string
    {

        return $this->controller;

    }

    /**
     * @inheritdoc
     */
    public function getControllerMethod(): ?string
    {

        return $this->controllerMethod;

    }

}