<?php

namespace Codememory\Components\Profiling\Interfaces;

/**
 * Interface SectionInterface
 *
 * @package Codememory\Components\Profiling\Interfaces
 *
 * @author  Codememory
 */
interface SectionInterface
{

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the section icon
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return string|null
     */
    public function getIcon(): ?string;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the path for the route of the current section
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return string
     */
    public function generateRoutePath(): string;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the name of the current section
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return string|null
     */
    public function getSectionName(): ?string;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the path of the content of the current section
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return string|null
     */
    public function getContentPath(): ?string;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the namespace of the controller of the current section
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return string|null
     */
    public function getController(): ?string;

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the method from the controller processed by the current section
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return string|null
     */
    public function getControllerMethod(): ?string;

}