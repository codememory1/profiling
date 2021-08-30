<?php

namespace Codememory\Components\Profiling\Sections;

use Codememory\Components\Profiling\Controllers\PerformanceController;
use Codememory\Components\Profiling\Sections\Subsections\PerformanceCompareSection;
use Codememory\Components\Profiling\Sections\Subsections\PerformanceListReportsSection;

/**
 * Class PerformanceSection
 *
 * @package Codememory\Components\Profiling\Sections
 *
 * @author  Codememory
 */
final class PerformanceSection extends AbstractSection
{

    /**
     * @inheritdoc
     */
    protected ?string $routePath = 'performance';

    /**
     * @inheritdoc
     */
    protected ?string $icon = '<i class="fas fa-analytics"></i>';

    /**
     * @inheritdoc
     */
    protected ?string $name = 'Performance';

    /**
     * @inheritdoc
     */
    protected ?string $contentPath = 'views/performance.php';

    /**
     * @inheritdoc
     */
    protected ?string $controller = PerformanceController::class;

    /**
     * @inheritdoc
     */
    protected ?string $controllerMethod = 'index';

    /**
     * @inheritdoc
     */
    protected array $subsections = [
        PerformanceListReportsSection::class,
        PerformanceCompareSection::class
    ];

}