<?php

namespace Codememory\Components\Profiling\Sections\Subsections;

use Codememory\Components\Profiling\Controllers\PerformanceController;
use Codememory\Components\Profiling\Sections\AbstractSection;

/**
 * Class PerformanceListReportsSection
 *
 * @package Codememory\Components\Profiling\Sections\Subsections
 *
 * @author  Codememory
 */
final class PerformanceListReportsSection extends AbstractSection
{

    /**
     * @inheritdoc
     */
    protected ?string $routePath = 'performance/list';

    /**
     * @inheritdoc
     */
    protected ?string $name = 'List of performance reports';

    /**
     * @inheritdoc
     */
    protected ?string $contentPath = 'views/performance-list-reports.php';

    /**
     * @inheritdoc
     */
    protected ?string $controller = PerformanceController::class;

    /**
     * @inheritdoc
     */
    protected ?string $controllerMethod = 'listReports';

}