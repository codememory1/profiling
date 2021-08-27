<?php

namespace Codememory\Components\Profiling\Sections\Subsections;

use Codememory\Components\Profiling\Controllers\PerformanceController;

/**
 * Class ComparePerformanceReports
 *
 * @package Codememory\Components\Profiling\Sections\Subsections
 *
 * @author  Codememory
 */
final class ComparePerformanceReports extends AbstractSubsection
{

    /**
     * @inheritDoc
     */
    protected ?string $sectionName = 'Compare performance reports';

    /**
     * @inheritDoc
     */
    protected ?string $contentPath = 'views/compare-performance-reports.php';

    /**
     * @inheritDoc
     */
    protected ?string $controller = PerformanceController::class;

    /**
     * @inheritDoc
     */
    protected ?string $controllerMethod = 'compare';

}