<?php

namespace Codememory\Components\Profiling\Sections\Builders;

use Codememory\Components\Profiling\Interfaces\BuilderInterface;

/**
 * Class EventsBuilder
 *
 * @package Codememory\Components\Profiling\Sections\Builders
 *
 * @author  Codememory
 */
final class EventsBuilder implements BuilderInterface
{

    /**
     * @var string|null
     */
    private ?string $event = null;

    /**
     * @var array
     */
    private array $listeners = [];

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
    private ?string $completed = null;

    /**
     * @var int|float
     */
    private int|float $leadTime = 0;

    /**
     * @param string $namespace
     *
     * @return $this
     */
    public function setEvent(string $namespace): EventsBuilder
    {

        $this->event = $namespace;

        return $this;

    }

    /**
     * @return string|null
     */
    public function getEvent(): ?string
    {

        return $this->event;

    }

    /**
     * @param array $listeners
     *
     * @return $this
     */
    public function setListeners(array $listeners): EventsBuilder
    {

        $this->listeners = $listeners;

        return $this;

    }

    /**
     * @return array
     */
    public function getListeners(): array
    {

        return $this->listeners;

    }

    /**
     * @param string $class
     * @param string $method
     *
     * @return $this
     */
    public function setDemanded(string $class, string $method): EventsBuilder
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
     * @param string $date
     *
     * @return $this
     */
    public function setCompleted(string $date): EventsBuilder
    {

        $this->completed = $date;

        return $this;

    }

    /**
     * @return string|null
     */
    public function getCompleted(): ?string
    {

        return $this->completed;

    }

    /**
     * @param int|float $ms
     *
     * @return $this
     */
    public function setLeadTime(int|float $ms): EventsBuilder
    {

        $this->leadTime = $ms;

        return $this;

    }

    /**
     * @return int|float
     */
    public function getLeadTime(): int|float
    {

        return $this->leadTime;

    }

}