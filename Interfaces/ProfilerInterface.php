<?php

namespace Codememory\Components\Profiling\Interfaces;

/**
 * Interface ProfilerInterface
 *
 * @package Codememory\Components\Profiling\Interfaces
 *
 * @author  Codememory
 */
interface ProfilerInterface
{

    /**
     * @param array $options
     *
     * @return void
     */
    public function enable(array $options = []): void;

    /**
     * @return void
     */
    public function profile(): void;

}