<?php

namespace Codememory\Components\Profiling\Sections;

use Codememory\Components\Profiling\Controllers\LoggingController;

/**
 * Class LoggingSection
 *
 * @package Codememory\Components\Profiling\Sections
 *
 * @author  Codememory
 */
final class LoggingSection extends AbstractSection
{

    /**
     * @inheritDoc
     */
    protected ?string $routePath = 'profiling/logging';

    /**
     * @inheritdoc
     */
    protected ?string $icon = '<i class="fas fa-file-signature"></i>';

    /**
     * @inheritdoc
     */
    protected ?string $name = 'Logging';

    /**
     * @inheritdoc
     */
    protected ?string $contentPath = 'views/logging.php';

    /**
     * @inheritdoc
     */
    protected ?string $controller = LoggingController::class;

    /**
     * @inheritdoc
     */
    protected ?string $controllerMethod = 'index';

}