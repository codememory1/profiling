<?php

namespace Codememory\Components\Profiling\Controllers;

use Codememory\Components\Profiling\Exceptions\SectionNotImplementInterfaceException;
use Codememory\Components\Profiling\TemplateRenderer;
use Codememory\Routing\Controller\AbstractController;
use ReflectionException;

/**
 * Class AbstractProfilerController
 *
 * @package Codememory\Components\Profiling\Controllers
 *
 * @author  Codememory
 */
abstract class AbstractProfilerController extends AbstractController
{

    /**
     * @param string      $section
     * @param array       $parameters
     * @param string|null $templatePath
     *
     * @return void
     * @throws SectionNotImplementInterfaceException
     * @throws ReflectionException
     */
    public function templateRender(string $section, array $parameters = [], ?string $templatePath = null): void
    {

        $templateRenderer = new TemplateRenderer($section, $parameters, $templatePath);

        $templateRenderer->render();

    }

}