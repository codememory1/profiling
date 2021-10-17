<?php

namespace Codememory\Components\Profiling\Sections;

use Codememory\Components\Profiling\Controllers\DatabaseController;

/**
 * Class DatabaseSection
 *
 * @package Codememory\Components\Profiling\Sections
 *
 * @author  Codememory
 */
final class DatabaseSection extends AbstractSection
{

    /**
     * @inheritDoc
     */
    protected ?string $routePath = '/profiling/database';

    /**
     * @inheritDoc
     */
    protected ?string $icon = '<i class="fas fa-database"></i>';

    /**
     * @inheritDoc
     */
    protected ?string $name = 'Database';

    /**
     * @inheritDoc
     */
    protected ?string $contentPath = 'views/database.php';

    /**
     * @inheritDoc
     */
    protected ?string $controller = DatabaseController::class;

    /**
     * @inheritDoc
     */
    protected ?string $controllerMethod = 'index';

}