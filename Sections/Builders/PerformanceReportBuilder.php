<?php

namespace Codememory\Components\Profiling\Sections\Builders;

use Codememory\Components\Profiling\Interfaces\BuilderInterface;

/**
 * Class PerformanceReportBuilder
 *
 * @package Codememory\Components\Profiling\Sections\Builders
 *
 * @author  Codememory
 */
final class PerformanceReportBuilder implements BuilderInterface
{

    /**
     * @var string|null
     */
    private ?string $hash = null;

    /**
     * @var int
     */
    private int $leadTime = 0;

    /**
     * @var array
     */
    private array $report = [];

    /**
     * @var string|null
     */
    private ?string $created = null;

    /**
     * @param string $hash
     *
     * @return $this
     */
    public function setHash(string $hash): PerformanceReportBuilder
    {

        $this->hash = $hash;

        return $this;

    }

    /**
     * @return string|null
     */
    public function getHash(): ?string
    {

        return $this->hash;

    }

    /**
     * @param int $leadTime
     *
     * @return $this
     */
    public function setLeadTime(int $leadTime): PerformanceReportBuilder
    {

        $this->leadTime = $leadTime;

        return $this;

    }

    /**
     * @return int
     */
    public function getLeadTime(): int
    {

        return $this->leadTime;

    }

    /**
     * @param array $report
     *
     * @return $this
     */
    public function setReport(array $report): PerformanceReportBuilder
    {

        $this->report = $report;

        return $this;

    }

    /**
     * @return array
     */
    public function getReport(): array
    {

        return $this->report;

    }

    /**
     * @param string $created
     *
     * @return $this
     */
    public function setCreated(string $created): PerformanceReportBuilder
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