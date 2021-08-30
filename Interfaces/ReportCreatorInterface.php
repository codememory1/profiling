<?php

namespace Codememory\Components\Profiling\Interfaces;

/**
 * Interface ReportCreatorInterface
 *
 * @package Codememory\Components\Profiling\Interfaces
 *
 * @author  Codememory
 */
interface ReportCreatorInterface
{

    /**
     * @param object $builder
     *
     * @return void
     */
    public function create(object $builder): void;

    /**
     * @param string|null $url
     *
     * @return array
     */
    public function get(?string $url = null): array;

}