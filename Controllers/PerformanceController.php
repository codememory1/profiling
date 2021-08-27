<?php

namespace Codememory\Components\Profiling\Controllers;

use Codememory\Components\Profiling\Preserver;
use Codememory\Components\Profiling\Sections\PerformanceSection;
use Codememory\Components\Profiling\Sections\Subsections\ComparePerformanceReports;
use Codememory\Components\Profiling\Sections\Subsections\ListPerformanceReports;
use Codememory\Components\Profiling\Sections\Subsections\PerformanceReportsResult;
use Codememory\Components\Profiling\XhprofWorker;
use Codememory\Container\ServiceProvider\Interfaces\ServiceProviderInterface;
use Codememory\HttpFoundation\Request\Request;
use Generator;

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
     * @param ServiceProviderInterface $serviceProvider
     */
    public function __construct(ServiceProviderInterface $serviceProvider)
    {

        parent::__construct($serviceProvider);

        $this->addGeneralParameters([
            'referer' => $this->get('request')->header->getHeader('Referer')
        ]);

    }

    /**
     * @return void
     */
    public function main(): void
    {

        $this->templateRender(new PerformanceSection());

    }

    /**
     * @return void
     */
    public function listReports(): void
    {

        $reports = Preserver::getReport(new PerformanceReportsResult());

        uasort($reports, function (array $one, array $two): bool {
            return $one['created'] < $two['created'];
        });

        $this->templateRender(new ListPerformanceReports(), [
            'list-reports' => $reports
        ]);

    }

    /**
     * @return void
     */
    public function compare(): void
    {

        $reports = Preserver::getReport(new PerformanceReportsResult());

        uasort($reports, function (array $one, array $two): bool {
            return $one['created'] < $two['created'];
        });

        $this->templateRender(new ComparePerformanceReports(), [
            'list-reports' => $reports
        ]);

    }

    /**
     * @param XhprofWorker $xhprofWorker
     *
     * @return void
     */
    public function result(XhprofWorker $xhprofWorker): void
    {

        /** @var Request $request */
        $request = $this->get('request');

        $reportsFromGet = $request->query()->get('reports');
        $openedFunctionFromGet = $request->query()->get('func');

        $reportHashes = null !== $reportsFromGet ? explode(',', $reportsFromGet) : [];

        $mainReport = $xhprofWorker->getReportByHash($reportHashes[0])['report'];
        $xhprofReport = $xhprofWorker->getFunctionsWithData($xhprofWorker->getUniqueFunctions($mainReport), $mainReport);
        $reportsForCompare = [];

        foreach ($reportHashes as $index => $reportHash) {
            if ($index !== 0) {
                $report = $xhprofWorker->getReportByHash($reportHash)['report'];

                $reportsForCompare[] = $xhprofWorker->getFunctionsWithData($xhprofWorker->getUniqueFunctions($report), $report);
            }
        }

        $compareReport = $xhprofWorker->compare($xhprofReport, ...$reportsForCompare)['report'];
        $present = function (){};

        if(count($reportHashes) > 1) {
            $present = function (int|float|string $one, int|float|string $two): int {
                return $this->getDifferenceToPresent($one, $two);
            };
        }

        $this->templateRender(new PerformanceReportsResult(), [
            'reports'                   => $reportHashes,
            'openedFunc'                => $openedFunctionFromGet,
            'functions'                 => $xhprofWorker->sortByKey($xhprofWorker->getAutoChildren($xhprofReport, $mainReport, $request->query()->get('function')), 'wt'),
            'iteration'                 => function (array $data): Generator {
                return $this->iteration($data);
            },
            'urlBuilder'                => function (array $parameters, ?string $url = null) use ($request) {
                return $this->addParametersToUrl($request, $parameters, $url);
            },
            'compare-report'            => $xhprofWorker->sortByKey($compareReport, 'wt.was'),
            'compare-report-added'      => $xhprofWorker->compare($xhprofReport, ...$reportsForCompare)['added'],
            'compare-report-removed'    => $xhprofWorker->compare($xhprofReport, ...$reportsForCompare)['removed'],
            'overall-comparison-result' => $xhprofWorker->overallComparisonResult($compareReport),
            'get-present'               => $present,
            'report-render'             => function (string $added, string $removed, ?int $present): string {
                return $this->renderReport($added, $removed, $present);
            }
        ]);

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

    /**
     * @param Request     $request
     * @param array       $parameters
     * @param string|null $url
     *
     * @return string
     */
    private function addParametersToUrl(Request $request, array $parameters, ?string $url = null): string
    {

        if (null === $url) {
            $url = $request->url->getUrl();
        }

        return $request->url->addParameters($url, $parameters);

    }

    /**
     * @param int|float|string $one
     * @param int|float|string $two
     *
     * @return int
     */
    private function getDifferenceToPresent(int|float|string $one, int|float|string $two): int
    {

        $one = abs((float) $one);
        $two = abs((float) $two);

        if ($one > $two) {
            return ($one - $two) / $one * 100;
        }

        return ($two - $one) / $two * 100;

    }

    /**
     * @param string   $added
     * @param string   $removed
     * @param int|null $present
     *
     * @return string
     */
    private function renderReport(string $added, string $removed, ?int $present): string
    {

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

    }

}