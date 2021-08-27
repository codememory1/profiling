<?php

namespace Codememory\Components\Profiling\Sections;

use Codememory\Components\Profiling\Controllers\PerformanceController;

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
    protected ?string $icon = '<i class="fas fa-analytics"></i>';

    /**
     * @inheritdoc
     */
    protected ?string $sectionName = 'Page performance';

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
    protected ?string $controllerMethod = 'main';

}