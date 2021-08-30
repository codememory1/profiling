<?php

namespace Codememory\Components\Profiling\Sections\Subsections;

use Codememory\Components\Profiling\Controllers\PerformanceController;
use Codememory\Components\Profiling\Sections\AbstractSection;

/**
 * Class PerformanceCompareSection
 *
 * @package Codememory\Components\Profiling\Sections\Subsections
 *
 * @author  Codememory
 */
final class PerformanceCompareSection extends AbstractSection
{

    /**
     * @inheritDoc
     */
    protected ?string $routePath = 'performance/compare';

    /**
     * @inheritDoc
     */
    protected ?string $name = 'Compare performance reports';

    /**
     * @inheritDoc
     */
    protected ?string $contentPath = 'views/performance-compare.php';

    /**
     * @inheritDoc
     */
    protected ?string $controller = PerformanceController::class;

    /**
     * @inheritDoc
     */
    protected ?string $controllerMethod = 'compare';

}