<?php

namespace Codememory\Components\Profiling\Sections\Builders;

use Codememory\Components\Profiling\Interfaces\BuilderInterface;
use Codememory\Support\Str;

/**
 * Class HomeBuilder
 *
 * @package Codememory\Components\Profiling\Sections\Builders
 *
 * @author  Codememory
 */
final class HomeBuilder implements BuilderInterface
{

    /**
     * @var string|null
     */
    private ?string $routePath = null;

    /**
     * @var string|null
     */
    private ?string $httpMethod = null;

    /**
     * @var string|null
     */
    private ?string $controller = null;

    /**
     * @var string|null
     */
    private ?string $controllerMethod = null;

    /**
     * @var string|null
     */
    private ?string $createDate = null;

    /**
     * @param string $path
     *
     * @return $this
     */
    public function setRoutePath(string $path): HomeBuilder
    {

        $this->routePath = $path;

        return $this;

    }

    /**
     * @return string|null
     */
    public function getRoutePath(): ?string
    {

        return $this->routePath;

    }

    /**
     * @param string $method
     *
     * @return $this
     */
    public function setHttpMethod(string $method): HomeBuilder
    {

        $this->httpMethod = Str::toUppercase($method);

        return $this;

    }

    /**
     * @return string|null
     */
    public function getHttpMethod(): ?string
    {

        return $this->httpMethod;

    }

    /**
     * @param string $namespace
     *
     * @return $this
     */
    public function setController(string $namespace): HomeBuilder
    {

        $this->controller = $namespace;

        return $this;

    }

    /**
     * @return string|null
     */
    public function getController(): ?string
    {

        return $this->controller;

    }

    /**
     * @param string $method
     *
     * @return $this
     */
    public function setControllerMethod(string $method): HomeBuilder
    {

        $this->controllerMethod = $method;

        return $this;

    }

    /**
     * @return string|null
     */
    public function getControllerMethod(): ?string
    {

        return $this->controllerMethod;

    }

    /**
     * @param string $date
     *
     * @return $this
     */
    public function setCreateDate(string $date): HomeBuilder
    {

        $this->createDate = $date;

        return $this;

    }

    /**
     * @return string|null
     */
    public function getCreatedDate(): ?string
    {

        return $this->createDate;

    }

}