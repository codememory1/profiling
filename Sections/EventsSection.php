<?php

namespace Codememory\Components\Profiling\Sections;

use Codememory\Components\Profiling\Controllers\EventsController;

/**
 * Class EventsSection
 *
 * @package Codememory\Components\Profiling\Sections
 *
 * @author  Codememory
 */
final class EventsSection extends AbstractSection
{

    /**
     * @inheritDoc
     */
    protected ?string $routePath = 'profiling/events';

    /**
     * @inheritDoc
     */
    protected ?string $icon = '<i class="fas fa-calendar-check"></i>';

    /**
     * @inheritDoc
     */
    protected ?string $name = 'Events';

    /**
     * @inheritDoc
     */
    protected ?string $contentPath = 'views/events.php';

    /**
     * @inheritDoc
     */
    protected ?string $controller = EventsController::class;

    /**
     * @inheritDoc
     */
    protected ?string $controllerMethod = 'index';

}