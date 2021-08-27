<?php

namespace Codememory\Components\Profiling\Controllers;

use Codememory\Components\Profiling\Interfaces\SectionInterface;
use Codememory\Components\Profiling\TemplateRenderer;
use Codememory\Container\ServiceProvider\Interfaces\ServiceProviderInterface;
use Codememory\Routing\Controller\AbstractController;

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
     * @var array
     */
    private array $generalParameters = [];

    /**
     * @param ServiceProviderInterface $serviceProvider
     */
    public function __construct(ServiceProviderInterface $serviceProvider)
    {

        parent::__construct($serviceProvider);

    }

    /**
     * @param array $parameters
     */
    protected function addGeneralParameters(array $parameters): void
    {

        $this->generalParameters = $parameters;

    }

    /**
     * @param SectionInterface $section
     * @param array            $parameters
     *
     * @return void
     */
    protected function templateRender(SectionInterface $section, array $parameters = []): void
    {

        $renderer = new TemplateRenderer($section, array_merge($parameters, $this->generalParameters));

        $renderer->render();

    }

}