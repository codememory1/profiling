<?php

namespace Codememory\Components\Profiling\Controllers;

use Codememory\Components\Profiling\Exceptions\SectionNotImplementInterfaceException;
use Codememory\Components\Profiling\ReportCreators\DatabaseReportCreator;
use Codememory\Components\Profiling\Resource;
use Codememory\Components\Profiling\Sections\Builders\DatabaseBuilder;
use Codememory\Components\Profiling\Sections\DatabaseSection;
use Codememory\Routing\Router;
use ReflectionException;

/**
 * Class DatabaseController
 *
 * @package Codememory\Components\Profiling\Controllers
 *
 * @author  Codememory
 */
class DatabaseController extends AbstractProfilerController
{

    /**
     * @throws SectionNotImplementInterfaceException
     * @throws ReflectionException
     */
    public function index()
    {


        $databaseReportCreator = new DatabaseReportCreator(Router::getCurrentRoute(), new DatabaseSection(new Resource()));
        $queries = $this->sortByDate($databaseReportCreator->get());

        $this->templateRender(DatabaseSection::class, [
            'queries' => $queries
        ]);

    }

    /**
     * @param array $logs
     *
     * @return array
     */
    private function sortByDate(array $logs): array
    {

        uasort($logs, function (DatabaseBuilder $one, DatabaseBuilder $two) {
            if ($one->getCreatedAt() === $two->getCreatedAt()) {
                return 0;
            }

            return $one->getCreatedAt() < $two->getCreatedAt() ? 1 : -1;
        });

        return $logs;

    }

}