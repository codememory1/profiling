<?php

namespace Codememory\Components\Profiling;

use Codememory\Components\Profiling\Interfaces\SectionInterface;

/**
 * Class TemplateRenderer
 *
 * @package Codememory\Components\Profiling
 *
 * @author  Codememory
 */
class TemplateRenderer
{

    private const DEFAULT_TEMPLATE = 'default.php';

    /**
     * @var SectionInterface
     */
    private SectionInterface $section;

    /**
     * @var array
     */
    private array $parameters;

    /**
     * @param SectionInterface $section
     * @param array            $parameters
     */
    public function __construct(SectionInterface $section, array $parameters = [])
    {

        $this->section = $section;
        $this->parameters = $parameters;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Rendering a section template
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return void
     */
    public function render(): void
    {

        require_once $this->getPathToResource(self::DEFAULT_TEMPLATE);

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the content of a section
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return string
     */
    public function getContent(): string
    {

        return file_get_contents($this->getPathToResource($this->section->getContentPath()));

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the parameters to be passed to the template
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @return array
     */
    public function getParameters(): array
    {

        return $this->parameters;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the full path to the resource folder
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string|null $path
     *
     * @return string
     */
    public function getPathToResource(?string $path = null): string
    {

        return __DIR__ . '/Resources/' . $path;

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Reads a specific resource file and returns
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $path
     *
     * @return string
     */
    public function getReadResource(string $path): string
    {

        return file_get_contents($this->getPathToResource($path));

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Returns the base64 text of a resource file
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param string $path
     *
     * @return string
     */
    public function getRecourseInBase(string $path): string
    {

        $path = $this->getPathToResource($path);
        $mimeType = str_replace([
            'plain'
        ], [
            pathinfo($path, PATHINFO_EXTENSION)
        ], mime_content_type($path));

        return sprintf('data:%s;base64,%s', $mimeType, base64_encode(file_get_contents($path)));

    }

    /**
     * =>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>=>
     * Overrides the built-in number_format function, changing only the default arguments
     * <=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=<=
     *
     * @param float  $num
     * @param int    $decimals
     * @param string $decimalSeparator
     * @param string $thousandsSeparator
     *
     * @return string
     */
    public function overrideNumberFormat(float $num, int $decimals = 0, string $decimalSeparator = ',', string $thousandsSeparator = ''): string
    {

        return number_format($num, $decimals, $decimalSeparator, $thousandsSeparator);

    }

}