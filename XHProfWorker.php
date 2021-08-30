<?php

namespace Codememory\Components\Profiling;

use Generator;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Class XHProfWorker
 *
 * @package Codememory\Components\Profiling
 *
 * @author  Codememory
 */
class XHProfWorker
{

    /**
     * @param array $originalReport
     *
     * @return array
     */
    public function getAllChildren(array $originalReport): array
    {

        $report = [];

        foreach ($this->iteration($originalReport) as $names => $data) {
            $functionNames = explode('==>', $names);

            if (count($functionNames) > 1) {
                $functionName = $functionNames[1];

                $report[$functionName] = $this->concatenateFunctionDataValues($functionName, $report, $data);
            }
        }

        return $report;

    }

    /**
     * @param array $originalReport
     *
     * @return array
     */
    public function getUniqueReport(array $originalReport): array
    {

        $report = $this->getAllChildren($originalReport);

        foreach ($this->iteration($originalReport) as $names => $data) {
            $functionNames = explode('==>', $names);

            if (!array_key_exists($functionNames[0], $report)) {
                $report[$functionNames[0]] = $data;
            }
        }

        return $report;

    }

    /**
     * @param string $parent
     * @param array  $originalReport
     *
     * @return array
     */
    public function getChildrenByParent(string $parent, array $originalReport): array
    {

        $report = [];

        foreach ($originalReport as $names => $data) {
            if (str_starts_with($names, sprintf('%s==>', $parent))) {
                $child = explode('==>', $names)[1];

                $report[$child] = $this->concatenateFunctionDataValues($child, $report, $data);
            }
        }

        return $report;

    }

    /**
     * @param string $functionName
     * @param array  $report
     * @param array  $data
     *
     * @return array
     */
    public function concatenateFunctionDataValues(string $functionName, array $report, array $data): array
    {

        if (array_key_exists($functionName, $report)) {
            $report[$functionName]['ct'] += $data['ct'];
            $report[$functionName]['wt'] += $data['wt'];
            $report[$functionName]['cpu'] += $data['cpu'];
            $report[$functionName]['mu'] += $data['mu'];
            $report[$functionName]['pmu'] += $data['pmu'];

            return $report[$functionName];
        }

        return $data;

    }

    /**
     * @param array $mainReport
     * @param mixed ...$reports
     *
     * @return array
     */
    #[ArrayShape(['report' => "array", 'added' => "array", 'removed' => "array"])]
    public function compareReports(array $mainReport, array ...$reports): array
    {

        $report = [
            'report'  => [],
            'added'   => [],
            'removed' => []
        ];

        foreach ($this->iteration($mainReport) as $name => $data) {
            foreach ($this->iteration($reports) as $reportIndex => $comparisonReport) {
                if (!array_key_exists($name, $comparisonReport)) {
                    $report['removed'][$reportIndex][$name] = $data;
                }
            }

            $ct = $this->joinReportValuesByKey($name, 'ct', ...$reports) - $data['ct'];
            $wt = $this->joinReportValuesByKey($name, 'wt', ...$reports) - $data['wt'];
            $cpu = $this->joinReportValuesByKey($name, 'cpu', ...$reports) - $data['cpu'];
            $mu = $this->joinReportValuesByKey($name, 'mu', ...$reports) - $data['mu'];
            $pmu = $this->joinReportValuesByKey($name, 'pmu', ...$reports) - $data['pmu'];

            $report['report'][$name] = [
                'ct'  => [
                    'was'     => $data['ct'],
                    'added'   => $ct > 0 ? $ct : null,
                    'removed' => $ct < 0 ? $ct : null
                ],
                'wt'  => [
                    'was'     => $data['wt'],
                    'added'   => $wt > 0 ? $wt : null,
                    'removed' => $wt < 0 ? $wt : null
                ],
                'cpu' => [
                    'was'     => $data['cpu'],
                    'added'   => $cpu > 0 ? $cpu : null,
                    'removed' => $cpu < 0 ? $cpu : null
                ],
                'mu'  => [
                    'was'     => $data['mu'],
                    'added'   => $mu > 0 ? $mu : null,
                    'removed' => $mu < 0 ? $mu : null
                ],
                'pmu' => [
                    'was'     => $data['pmu'],
                    'added'   => $pmu > 0 ? $pmu : null,
                    'removed' => $pmu < 0 ? $pmu : null
                ]
            ];
        }

        foreach ($reports as $reportIndex => $comparisonReport) {
            foreach ($this->iteration($comparisonReport) as $name => $data) {
                if (!array_key_exists($name, $mainReport)) {
                    $report['added'][$reportIndex][$name] = $data;
                }
            }
        }

        return $report;

    }

    /**
     * @param string $functionName
     * @param string $valueKey
     * @param mixed  ...$reports
     *
     * @return int|float
     */
    public function joinReportValuesByKey(string $functionName, string $valueKey, array ...$reports): int|float
    {

        $result = 0;

        foreach ($this->iteration($reports) as $report) {
            if (array_key_exists($functionName, $report)) {
                $result += $report[$functionName][$valueKey];
            }

            break;
        }

        return $result;

    }

    /**
     * @param array $data
     *
     * @return Generator
     */
    private function iteration(array $data): Generator
    {

        foreach ($data as $key => $value) {
            yield $key => $value;
        }

    }

}