<?php

namespace Codememory\Components\Profiling\Controllers;

use Codememory\Components\DateTime\Exceptions\InvalidTimezoneException;
use Codememory\Components\DateTime\Time;
use Codememory\Components\Profiling\Exceptions\SectionNotImplementInterfaceException;
use Codememory\Components\Profiling\ReportCreators\PerformanceReportCreator;
use Codememory\Components\Profiling\Resource;
use Codememory\Components\Profiling\Sections\Builders\PerformanceReportBuilder;
use Codememory\Components\Profiling\Sections\PerformanceSection;
use Codememory\Components\Profiling\Sections\Subsections\PerformanceCompareSection;
use Codememory\Components\Profiling\Sections\Subsections\PerformanceListReportsSection;
use Codememory\Components\Profiling\Sections\Subsections\PerformanceReportResultSection;
use Codememory\Components\Profiling\XHProfWorker;
use Codememory\HttpFoundation\Request\Request;
use Codememory\Routing\Router;
use Generator;
use JetBrains\PhpStorm\ArrayShape;
use ReflectionException;

/**
 * Class PerformanceController
 *
 * @package Codememory\Components\Profiling\Controllers
 *
 * @author  Codememory
 */
class PerformanceController extends AbstractProfilerController
{

    /**
     * @return void
     * @throws ReflectionException
     * @throws SectionNotImplementInterfaceException
     */
    public function index(): void
    {

        $this->templateRender(PerformanceSection::class);

    }

    /**
     * @return void
     * @throws ReflectionException
     * @throws SectionNotImplementInterfaceException
     * @throws InvalidTimezoneException
     */
    public function compare(): void
    {

        $reports = new PerformanceReportCreator(Router::getCurrentRoute(), new PerformanceSection(new Resource()));

        $this->templateRender(PerformanceCompareSection::class, [
            'reports'  => $this->sortByDate($reports->get()),
            'now-time' => (new Time())->now()
        ]);

    }

    /**
     * @return void
     * @throws InvalidTimezoneException
     * @throws ReflectionException
     * @throws SectionNotImplementInterfaceException
     */
    public function listReports(): void
    {

        $reports = new PerformanceReportCreator(Router::getCurrentRoute(), new PerformanceSection(new Resource()));

        $this->templateRender(PerformanceListReportsSection::class, [
            'reports'  => $this->sortByDate($reports->get()),
            'now-time' => (new Time())->now()
        ]);

    }

    /**
     * @return void
     * @throws ReflectionException
     * @throws SectionNotImplementInterfaceException
     */
    public function result(): void
    {

        /** @var Request $request */
        $request = $this->get('request');

        $reports = new PerformanceReportCreator(Router::getCurrentRoute(), new PerformanceSection(new Resource()));

        $openedHashes = explode(',', $request->query()->get('reports'));

        $this->templateRender(PerformanceReportResultSection::class, [
            'opened-hashes'      => $openedHashes,
            'full-reports'       => $reports->get(),
            'report'             => $this->getReport($request, $reports->get(), $openedHashes),
            'iteration'          => $this->iteration(),
            'url-builder'        => $this->addParametersToUrl($request),
            'opened-function'    => $request->query()->get('function'),
            'overall-comparison' => $this->overallComparisonResult(),
            'diff-to-present'    => $this->getDifferenceToPresent(),
            'render-report'      => $this->renderReport(),
            'sort-report'        => $this->sortReport()
        ]);

    }

    /**
     * @param Request $request
     * @param array   $allReports
     * @param array   $openedHashes
     *
     * @return array
     */
    private function getReport(Request $request, array $allReports, array $openedHashes): array
    {

        $XHProfWorker = new XHProfWorker();

        if (count($openedHashes) > 1) {
            $reports = [];

            foreach ($openedHashes as $openedHash) {
                $report = $this->getReportByHash($allReports, $openedHash);

                if (null !== $report) {
                    $reports[] = $XHProfWorker->getUniqueReport($report->getReport());
                }
            }

            $mainReport = $reports[array_key_first($reports)];

            unset($reports[array_key_first($reports)]);

            return $XHProfWorker->compareReports($mainReport, ...$reports);
        } else if (count($openedHashes) === 1 && null !== $request->query()->get('function')) {
            $report = $this->getReportByHash($allReports, $openedHashes[array_key_first($openedHashes)])->getReport();

            if (null !== $report) {
                return $XHProfWorker->getChildrenByParent($request->query()->get('function'), $report);
            }

            return [];
        }

        $report = $this->getReportByHash($allReports, $openedHashes[array_key_first($openedHashes)])->getReport();

        if (null !== $report) {
            return $XHProfWorker->getUniqueReport($report);
        }

        return [];

    }

    /**
     * @param array  $reports
     * @param string $hash
     *
     * @return PerformanceReportBuilder|null
     */
    private function getReportByHash(array $reports, string $hash): ?PerformanceReportBuilder
    {

        foreach ($reports as $report) {
            if ($report->getHash() === $hash) {
                return $report;
            }
        }

        return null;

    }

    /**
     * @param array $logs
     *
     * @return array
     */
    private function sortByDate(array $logs): array
    {

        uasort($logs, function (PerformanceReportBuilder $one, PerformanceReportBuilder $two) {
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
    private function iteration(): callable
    {

        return function (array $data): Generator {
            foreach ($data as $key => $value) {
                yield $key => $value;
            }
        };

    }

    /**
     * @param Request $request
     *
     * @return callable
     */
    private function addParametersToUrl(Request $request): callable
    {

        return function (array $parameters, ?string $url = null) use ($request) {
            if (null === $url) {
                $url = $request->url->getUrl();
            }

            return $request->url->addParameters($url, $parameters);
        };

    }

    /**
     * @return callable
     */
    #[ArrayShape([
        'wt'  => "int[]",
        'cpu' => "int[]",
        'mu'  => "int[]",
        'pmu' => "int[]"
    ])]
    private function overallComparisonResult(): callable
    {

        return function (array $compareReport) {
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
        };

    }

    /**
     * @return callable
     */
    private function getDifferenceToPresent(): callable
    {

        return function (int|float|string $one, int|float|string $two) {
            $one = abs((float) $one);
            $two = abs((float) $two);

            if ($one > $two) {
                return round(($one - $two) / (0 === $one ? 1 : $one) * 100);
            } else if ($two > $one) {
                return round(($two - $one) / (0 === $two ? 1 : $two) * 100);
            }

            return 0;
        };

    }

    /**
     * @return callable
     */
    private function sortReport(): callable
    {

        return function (array $report, string $key): array {
            uasort($report, function (array $one, array $two) use ($key) {
                if ($one[$key] === $two[$key]) {
                    return 0;
                }

                return $one[$key] < $two[$key] ? 1 : -1;
            });

            return $report;
        };

    }

    /**
     * @return callable
     */
    private function renderReport(): callable
    {

        return function (string $added, string $removed, ?int $present) {
            $added = (float) $added;
            $removed = (float) $removed;
            $present = $present ?: 0;

            if (abs($removed) > $added && $present > 10) {
                return <<<HTML
                <div class="end__report green">
                    <span class="square green"></span>
                    <span class="report__message">Report: OK! You removed more than 10% than you added!</span>
                </div>
                HTML;
            } else if (abs($removed) > $added && $present < 10) {
                return <<<HTML
                <div class="end__report orange">
                    <span class="square orange"></span>
                    <span class="report__message">Report: Not so good! The difference in numbers is not big.</span>
                </div>
                HTML;
            }

            return <<<HTML
            <div class="end__report red">
                <span class="square red"></span>
                <span class="report__message">Report: Bad report! Added more than removed</span>
            </div>
            HTML;
        };

    }

}