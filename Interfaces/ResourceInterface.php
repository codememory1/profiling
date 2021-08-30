<?php

namespace Codememory\Components\Profiling\Interfaces;

/**
 * Interface ResourceInterface
 *
 * @package Codememory\Components\Profiling\Interfaces
 *
 * @author  Codememory
 */
interface ResourceInterface
{

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Get full path to resources
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string|null $path
     *
     * @return string
     */
    public function getPath(?string $path = null): string;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Base64 HTML encodes resource
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $resource
     *
     * @return string
     */
    public function getResourceInBase64(string $resource): string;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the MimeType of the resource
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $resource
     *
     * @return string
     */
    public function getExactMimeType(string $resource): string;

}