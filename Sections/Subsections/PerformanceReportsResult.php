<?php

namespace Codememory\Components\Profiling\Sections\Subsections;

use Codememory\Components\Profiling\Controllers\PerformanceController;

/**
 * Class PerformanceReportsResult
 *
 * @package Codememory\Components\Profiling\Sections\Subsections
 *
 * @author  Codememory
 */
class PerformanceReportsResult extends AbstractSubsection
{

    /**
     * @inheritDoc
     */
    protected ?string $sectionName = 'Performance reports result';

    /**
     * @inheritDoc
     */
    protected ?string $contentPath = 'views/performance-reports-result.php';

    /**
     * @inheritDoc
     */
    protected ?string $controller = PerformanceController::class;

    /**
     * @inheritDoc
     */
    protected ?string $controllerMethod = 'result';

}