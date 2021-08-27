<?php

namespace Codememory\Components\Profiling\Sections;

use Codememory\Components\Profiling\Controllers\EventsController;

/**
 * Class EventSection
 *
 * @package Codememory\Components\Profiling\Sections
 *
 * @author  Codememory
 */
final class EventSection extends AbstractSection
{

    /**
     * @inheritDoc
     */
    protected ?string $icon = '<i class="fas fa-calendar-check"></i>';

    /**
     * @inheritDoc
     */
    protected ?string $sectionName = 'Events';

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
    protected ?string $controllerMethod = 'main';

}