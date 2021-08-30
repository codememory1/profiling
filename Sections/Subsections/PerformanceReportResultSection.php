<?php

namespace Codememory\Components\Profiling\Sections\Subsections;

use Codememory\Components\Profiling\Controllers\PerformanceController;
use Codememory\Components\Profiling\Sections\AbstractSection;

/**
 * Class PerformanceReportResultSection
 *
 * @package Codememory\Components\Profiling\Sections\Subsections
 *
 * @author  Codememory
 */
final class PerformanceReportResultSection extends AbstractSection
{

    /**
     * @inheritDoc
     */
    protected ?string $routePath = 'performance/result';

    /**
     * @inheritDoc
     */
    protected ?string $name = 'Performance reports result';

    /**
     * @inheritDoc
     */
    protected ?string $contentPath = 'views/performance-report-result.php';

    /**
     * @inheritDoc
     */
    protected ?string $controller = PerformanceController::class;

    /**
     * @inheritDoc
     */
    protected ?string $controllerMethod = 'result';

}