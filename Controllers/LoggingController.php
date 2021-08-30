<?php

namespace Codememory\Components\Profiling\Controllers;

use Codememory\Components\Profiling\Exceptions\SectionNotImplementInterfaceException;
use Codememory\Components\Profiling\ReportCreators\LoggingReportCreator;
use Codememory\Components\Profiling\Resource;
use Codememory\Components\Profiling\Sections\Builders\LoggingBuilder;
use Codememory\Components\Profiling\Sections\LoggingSection;
use Codememory\Routing\Router;
use Codememory\Support\Str;
use JetBrains\PhpStorm\Pure;
use ReflectionException;

/**
 * Class LoggingController
 *
 * @package Codememory\Components\Profiling\Controllers
 *
 * @author  Codememory
 */
class LoggingController extends AbstractProfilerController
{

    /**
     * @return void
     * @throws SectionNotImplementInterfaceException
     * @throws ReflectionException
     */
    public function index(): void
    {

        $loggingReportCreator = new LoggingReportCreator(Router::getCurrentRoute(), new LoggingSection(new Resource()));

        $logs = $this->sortByDate($loggingReportCreator->get());

        $this->templateRender(LoggingSection::class, [
            'logs'        => $logs,
            'sort-logs'   => $this->sortLogsByLevel($logs),
            'level-class' => $this->getLevelClass(),
        ]);

    }

    /**
     * @param array $logs
     *
     * @return callable
     */
    private function sortLogsByLevel(array $logs): callable
    {

        return function (string $level) use ($logs) {
            $sortedLogs = [];

            /** @var LoggingBuilder $log */
            foreach ($logs as $log) {
                if ($log->getLevel() === Str::toUppercase($level)) {
                    $sortedLogs[] = $log;
                }
            }

            return $sortedLogs;
        };

    }

    /**
     * @param array $logs
     *
     * @return array
     */
    private function sortByDate(array $logs): array
    {

        uasort($logs, function (LoggingBuilder $one, LoggingBuilder $two) {
            if ($one->getCreated() === $two->getCreated()) {
                return 0;
            }

            return $one->getCreated() < $two->getCreated() ? 1 : -1;
        });

        return $logs;

    }

    /**
     * @return callable
     */
    #[Pure]
    private function getLevelClass(): callable
    {

        return function (string $level): string {
            return match (Str::toUppercase($level)) {
                'ERROR' => 'red',
                'DEBUG' => 'dark',
                'WARNING' => 'warning',
                'NOTICE' => 'blue',
                'ALERT' => 'alert',
                default => 'yellow',
            };
        };

    }

}