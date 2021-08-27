<?php

namespace Codememory\Components\Profiling\Interfaces;

/**
 * Interface ProfilerCacheInterface
 *
 * @package Codememory\Components\Profiling\Interfaces
 *
 * @author  Codememory
 */
interface ProfilerCacheInterface
{

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Add new statistics for a specific section and a specific page to the cache
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $page
     * @param string $sectionName
     * @param array  $data
     * @param bool   $asAdd
     *
     * @return ProfilerCacheInterface
     */
    public function add(string $page, string $sectionName, array $data, bool $asAdd = false): ProfilerCacheInterface;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns section statistics for all profiled pages
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return array
     */
    public function getAll(): array;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Get information from a profiled page of a specific section
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $page
     * @param string $sectionName
     *
     * @return array
     */
    public function get(string $page, string $sectionName): array;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Delete all profiled pages
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return void
     */
    public function removeAllStatistic(): void;

}