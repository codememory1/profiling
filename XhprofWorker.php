<?php

namespace Codememory\Components\Profiling;

use Codememory\Components\DateTime\DateTime;
use Codememory\Components\DateTime\Exceptions\InvalidTimezoneException;
use Codememory\Components\Profiling\Sections\Subsections\PerformanceReportsResult;
use Codememory\Support\Arr;
use Codememory\Support\Str;
use Exception;
use Generator;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Class XhprofWorker
 *
 * @package Codememory\Components\Profiling
 *
 * @author  Codememory
 */
class XhprofWorker
{

    /**
     * @param array $report
     *
     * @return array
     */
    public function getUniqueFunctions(array $report): array
    {

        $uniqueFunctionNames = [];

        foreach ($this->iteration($report) as $function => $data) {
            foreach (explode('==>', $function) as $name) {
                if (!in_array($name, $uniqueFunctionNames)) {
                    $uniqueFunctionNames[] = $name;
                }
            }
        }

        return $uniqueFunctionNames;

    }

    /**
     * @param string $functionName
     * @param array  $report
     *
     * @return array
     */
    public function getChildren(string $functionName, array $report): array
    {

        $found = [];

        foreach ($this->iteration($report) as $functions => $data) {
            if (Str::starts($functions, $functionName . '==>')) {
                $found[explode('==>', $functions)[1]] = $data;
            }
        }

        return $found;

    }

    /**
     * @param string $endFunction
     * @param array  $report
     *
     * @return array
     */
    public function getParents(string $endFunction, array $report): array
    {

        $found = [];

        foreach ($this->iteration($report) as $functions => $data) {
            if (Str::ends($functions, '==>' . $endFunction)) {
                $found[explode('==>', $functions)[0]] = $data;
            }
        }

        return $found;

    }

    /**
     * @param array $names
     * @param array $report
     *
     * @return array
     */
    public function getFunctionsWithData(array $names, array $report): array
    {


        $namesWithData = [];

        foreach ($this->iteration($report) as $functionNames => $data) {
            $functions = explode('==>', $functionNames);
            $lastFunctionName = $functions[array_key_last($functions)];

            if (in_array($lastFunctionName, $names)) {
                $namesWithData[$lastFunctionName] = $data;
            }
        }

        return $namesWithData;

    }

    /**
     * @param array  $functions
     * @param string $key
     *
     * @return int
     */
    public function combineValuesByKey(array $functions, string $key): int
    {

        $combinedValue = 0;

        foreach ($this->iteration($functions) as $data) {
            $combinedValue += $data[$key];
        }

        return $combinedValue;

    }

    /**
     * @param array  $report
     * @param string $key
     *
     * @return array
     */
    public function sortByKey(array $report, string $key): array
    {

        uasort($report, function (array $one, array $two) use ($key) {
            return Arr::set($one)::get($key) < Arr::set($two)::get($key);
        });

        return $report;

    }

    /**
     * @param array       $default
     * @param array       $reports
     * @param string|null $functionName
     *
     * @return array
     */
    public function getAutoChildren(array $default, array $reports, ?string $functionName = null): array
    {

        if (null === $functionName) {
            $functions = $default;
        } else {
            $functions = $this->getChildren($functionName, $reports);
        }

        foreach ($functions as $functionName => &$data) {
            $children = $this->getChildren($functionName, $reports);

            $data['wt'] += $this->combineValuesByKey($children, 'wt');
            $data['cpu'] += $this->combineValuesByKey($children, 'cpu');
            $data['mu'] += $this->combineValuesByKey($children, 'mu');
            $data['pmu'] += $this->combineValuesByKey($children, 'pmu');
        }

        return $functions;

    }

    /**
     * @param array $mainReport
     * @param mixed ...$reports
     *
     * @return array
     */
    #[ArrayShape([
        'report'  => "array",
        'added'   => "array",
        'removed' => "array"
    ])]
    public function compare(array $mainReport, array ...$reports): array
    {

        $result = [
            'report'  => [],
            'added'   => [],
            'removed' => []
        ];

        foreach ($this->iteration($mainReport) as $functionName => $data) {
            foreach ($reports as $index => $report) {
                if (!array_key_exists($functionName, $report)) {
                    $result['removed'][$index][$functionName] = $data;
                }
            }

            $ct = $this->deductFromReportsByKey($functionName, 'ct', $data, ...$reports);
            $wt = $this->deductFromReportsByKey($functionName, 'wt', $data, ...$reports);
            $cpu = $this->deductFromReportsByKey($functionName, 'cpu', $data, ...$reports);
            $mu = $this->deductFromReportsByKey($functionName, 'mu', $data, ...$reports);
            $pmu = $this->deductFromReportsByKey($functionName, 'pmu', $data, ...$reports);

            $result['report'][$functionName] = [
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

        foreach ($reports as $index => $report) {
            foreach ($this->iteration($report) as $functionName => $data) {
                if (!array_key_exists($functionName, $mainReport)) {
                    $result['added'][$index][$functionName] = $data;
                }
            }
        }

        return $result;

    }

    /**
     * @param array $compareReport
     *
     * @return array
     */
    #[ArrayShape(['wt' => "int[]", 'cpu' => "int[]", 'mu' => "int[]", 'pmu' => "int[]"])]
    public function overallComparisonResult(array $compareReport): array
    {

        $result = [
            'wt'  => [
                'added'   => 0,
                'removed' => 0
            ],
            'cpu' => [
                'added'   => 0,
                'removed' => 0
            ],
            'mu'  => [
                'added'   => 0,
                'removed' => 0
            ],
            'pmu' => [
                'added'   => 0,
                'removed' => 0
            ]
        ];

        foreach ($compareReport as $data) {
            $result['wt']['added'] += $data['wt']['added'];
            $result['cpu']['added'] += $data['cpu']['added'];
            $result['mu']['added'] += $data['mu']['added'];
            $result['pmu']['added'] += $data['pmu']['added'];
            $result['wt']['removed'] += $data['wt']['removed'];
            $result['cpu']['removed'] += $data['cpu']['removed'];
            $result['mu']['removed'] += $data['mu']['removed'];
            $result['pmu']['removed'] += $data['pmu']['removed'];
        }

        return $result;

    }

    /**
     * @param string $functionName
     * @param mixed  ...$reports
     *
     * @return bool
     */
    public function existFunctionToReports(string $functionName, array ...$reports): bool
    {

        $exist = false;

        foreach ($reports as $report) {
            if (array_key_exists($functionName, $report)) {
                $exist = true;
            }
        }

        return $exist;

    }

    /**
     * @return array
     */
    public function getReports(): array
    {

        return Preserver::getReport(new PerformanceReportsResult());
    }

    /**
     * @param string $hash
     *
     * @return array
     */
    public function getReportByHash(string $hash): array
    {

        foreach ($this->getReports() as $report) {
            if($report['hash'] === $hash) {
                return $report;
            }
        }

        return [];

    }

    /**
     * @param array $report
     *
     * @return $this
     * @throws InvalidTimezoneException
     * @throws Exception
     */
    public function addReport(array $report): XhprofWorker
    {

        Preserver::saveReport(new PerformanceReportsResult(), [
            'hash' => bin2hex(random_bytes(10)),
            'created' => (new DateTime())->format('Y-m-d H:i:s'),
            'report' => $report
        ], true);

        return $this;

    }

    /**
     * @param string $functionName
     * @param string $key
     * @param mixed  ...$reports
     *
     * @return int|null
     */
    private function deductFromReportsByKey(string $functionName, string $key, array $functionData, array ...$reports): ?int
    {

        $result = null;

        foreach ($this->iteration($reports) as $report) {
            if (array_key_exists($functionName, $report)) {
                if(null === $result) {
                    $result = $report[$functionName][$key];
                } else {
                    $result += $report[$functionName][$key];
                }
            }

            break;
        }

        return null !== $result ? $result - $functionData[$key] : null;

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