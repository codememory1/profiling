<?php

namespace Codememory\Components\Profiling\Sections\Builders;

use Codememory\Components\Profiling\Interfaces\BuilderInterface;
use Codememory\Support\Str;

/**
 * Class LoggingBuilder
 *
 * @package Codememory\Components\Profiling\Sections\Builders
 *
 * @author  Codememory
 */
final class LoggingBuilder implements BuilderInterface
{

    /**
     * @var string|null
     */
    private ?string $demandedClass = null;

    /**
     * @var string|null
     */
    private ?string $demandedMethod = null;

    /**
     * @var string|null
     */
    private ?string $level = null;

    /**
     * @var string|null
     */
    private ?string $message = null;

    /**
     * @var string|null
     */
    private ?string $context = null;

    /**
     * @var string|null
     */
    public ?string $created = null;

    /**
     * @param string $class
     * @param string $method
     *
     * @return $this
     */
    public function setDemanded(string $class, string $method): LoggingBuilder
    {

        $this->demandedClass = $class;
        $this->demandedMethod = $method;

        return $this;

    }

    /**
     * @return string|null
     */
    public function getDemandedClass(): ?string
    {

        return $this->demandedClass;

    }

    /**
     * @return string|null
     */
    public function getDemandedMethod(): ?string
    {

        return $this->demandedMethod;

    }

    /**
     * @param string $level
     *
     * @return $this
     */
    public function setLevel(string $level): LoggingBuilder
    {

        $this->level = Str::toUppercase($level);

        return $this;

    }

    /**
     * @return string|null
     */
    public function getLevel(): ?string
    {

        return $this->level;

    }

    /**
     * @param string $message
     *
     * @return LoggingBuilder
     */
    public function setMessage(string $message): LoggingBuilder
    {

        $this->message = $message;

        return $this;

    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {

        return $this->message;

    }

    /**
     * @param array|string $context
     *
     * @return $this
     */
    public function setContext(array|string $context): LoggingBuilder
    {

        $this->context = is_array($context) ? json_encode($context) : $context;

        return $this;

    }

    /**
     * @return string|null
     */
    public function getContext(): ?string
    {

        return $this->context;

    }

    /**
     * @param string $created
     *
     * @return $this
     */
    public function setCreated(string $created): LoggingBuilder
    {

        $this->created = $created;

        return $this;

    }

    /**
     * @return string|null
     */
    public function getCreated(): ?string
    {

        return $this->created;

    }

}