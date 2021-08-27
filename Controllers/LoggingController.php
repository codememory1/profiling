<?php

namespace Codememory\Components\Profiling\Controllers;

use Codememory\Components\Profiling\Preserver;
use Codememory\Components\Profiling\Sections\LoggingSection;
use Codememory\Support\Str;
use JetBrains\PhpStorm\Pure;

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
     * @param LoggingSection $section
     *
     * @return void
     */
    public function main(LoggingSection $section): void
    {

        $logs = Preserver::getReport($section);

        $this->templateRender($section, [
            'allLogs'     => $logs,
            'errorLogs'   => $this->getLogsByLevel($logs, 'error'),
            'debugLogs'   => $this->getLogsByLevel($logs, 'debug'),
            'warningLogs' => $this->getLogsByLevel($logs, 'warning'),
            'noticeLogs'  => $this->getLogsByLevel($logs, 'notice'),
            'alertLogs'   => $this->getLogsByLevel($logs, 'alert'),
            'classLevel'  => function (string $level): string {
                return $this->getLevelClass($level);
            }
        ]);

    }

    /**
     * @param array  $logs
     * @param string $level
     *
     * @return array
     */
    private function getLogsByLevel(array $logs, string $level): array
    {

        return array_filter($logs, function (mixed $data) use ($level) {
            return $data['level'] === Str::toUppercase($level);
        });

    }

    /**
     * @param string $level
     *
     * @return string
     */
    #[Pure]
    private function getLevelClass(string $level): string
    {

        return match (Str::toUppercase($level)) {
            'ERROR' => 'red',
            'DEBUG' => 'dark',
            'WARNING' => 'warning',
            'NOTICE' => 'blue',
            'ALERT' => 'alert',
            default => 'yellow',
        };

    }

}