<?php

namespace Codememory\Components\Profiling\Sections;

use Codememory\Components\Profiling\Controllers\HomeController;
use Codememory\Components\Profiling\Sections\Builders\HomeBuilder;
use Codememory\Routing\Route;

/**
 * Class HomeSection
 *
 * @package Codememory\Components\Profiling\Sections
 *
 * @author  Codememory
 */
final class HomeSection extends AbstractSection
{

    /**
     * @inheritDoc
     */
    protected ?string $routePath = '/';

    /**
     * @inheritDoc
     */
    protected ?string $icon = '<i class="fas fa-home"></i>';

    /**
     * @inheritDoc
     */
    protected ?string $name = 'Profiler';

    /**
     * @inheritDoc
     */
    protected ?string $contentPath = 'views/home.php';

    /**
     * @inheritDoc
     */
    protected ?string $controller = HomeController::class;

    /**
     * @inheritDoc
     */
    protected ?string $controllerMethod = 'index';

}