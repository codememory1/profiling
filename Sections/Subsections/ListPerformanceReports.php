<?php

namespace Codememory\Components\Profiling\Sections\Subsections;

use Codememory\Components\Profiling\Controllers\PerformanceController;

/**
 * Class ListPerformanceReports
 *
 * @package Codememory\Components\Profiling\Sections\Subsections
 *
 * @author  Codememory
 */
final class ListPerformanceReports extends AbstractSubsection
{

    /**
     * @inheritdoc
     */
    protected ?string $sectionName = 'List of performance reports';

    /**
     * @inheritdoc
     */
    protected ?string $contentPath = 'views/list-performance-reports.php';

    /**
     * @inheritdoc
     */
    protected ?string $controller = PerformanceController::class;

    /**
     * @inheritdoc
     */
    protected ?string $controllerMethod = 'listReports';

}