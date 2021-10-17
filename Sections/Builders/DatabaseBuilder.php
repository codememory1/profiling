<?php

namespace Codememory\Components\Profiling\Sections\Builders;

use Codememory\Components\Profiling\Interfaces\BuilderInterface;

/**
 * Class DatabaseBuilder
 *
 * @package Codememory\Components\Profiling\Sections\Builders
 *
 * @author  Codememory
 */
final class DatabaseBuilder implements BuilderInterface
{

    /**
     * @var string|null
     */
    private ?string $repository = null;

    /**
     * @var string|null
     */
    private ?string $connector = null;

    /**
     * @var string|null
     */
    private ?string $query = null;

    /**
     * @var int|null
     */
    private ?int $duration = null;

    /**
     * @var string|null
     */
    private ?string $createdAt = null;

    /**
     * @return string|null
     */
    public function getRepository(): ?string
    {

        return $this->repository;

    }

    /**
     * @param string|null $repository
     *
     * @return DatabaseBuilder
     */
    public function setRepository(?string $repository): DatabaseBuilder
    {

        $this->repository = $repository;

        return $this;

    }

    /**
     * @return string|null
     */
    public function getConnector(): ?string
    {

        return $this->connector;

    }

    /**
     * @param string|null $connector
     *
     * @return DatabaseBuilder
     */
    public function setConnector(?string $connector): DatabaseBuilder
    {

        $this->connector = $connector;

        return $this;

    }

    /**
     * @return string|null
     */
    public function getQuery(): ?string
    {

        return $this->query;

    }

    /**
     * @param string|null $query
     *
     * @return DatabaseBuilder
     */
    public function setQuery(?string $query): DatabaseBuilder
    {

        $this->query = $query;

        return $this;

    }

    /**
     * @return int|null
     */
    public function getDuration(): ?int
    {

        return $this->duration;

    }

    /**
     * @param int|null $duration
     *
     * @return DatabaseBuilder
     */
    public function setDuration(?int $duration): DatabaseBuilder
    {

        $this->duration = $duration;

        return $this;

    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {

        return $this->createdAt;

    }

    /**
     * @param string|null $createdAt
     *
     * @return DatabaseBuilder
     */
    public function setCreatedAt(?string $createdAt): DatabaseBuilder
    {

        $this->createdAt = $createdAt;

        return $this;

    }


}