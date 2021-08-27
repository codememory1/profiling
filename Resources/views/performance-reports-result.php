<?php

use Codememory\Components\Profiling\Profiler;
use Codememory\Components\Profiling\Sections\Subsections\ListPerformanceReports;

$overallComparison = $this->getParameters()['overall-comparison-result'];

$overallComparisonWtAddedMS = $this->overrideNumberFormat($overallComparison['wt']['added'] / 1000, 3);
$overallComparisonWtAddedS = $this->overrideNumberFormat(($overallComparison['wt']['added'] / 1000) / 1000, 3);
$overallComparisonWtRemovedMS = $this->overrideNumberFormat($overallComparison['wt']['removed'] / 1000, 3);
$overallComparisonWtRemovedS = $this->overrideNumberFormat(($overallComparison['wt']['removed'] / 1000) / 1000, 3);
$wtPresent = $this->getParameters()['get-present']($overallComparisonWtAddedMS, $overallComparisonWtRemovedMS);

$overallComparisonCpuAddedMS = $this->overrideNumberFormat($overallComparison['cpu']['added'] / 1000, 3);
$overallComparisonCpuAddedS = $this->overrideNumberFormat(($overallComparison['cpu']['added'] / 1000) / 1000, 3);
$overallComparisonCpuRemovedMS = $this->overrideNumberFormat($overallComparison['cpu']['removed'] / 1000, 3);
$overallComparisonCpuRemovedS = $this->overrideNumberFormat(($overallComparison['cpu']['removed'] / 1000) / 1000, 3);
$cpuPresent = $this->getParameters()['get-present']($overallComparisonCpuAddedMS, $overallComparisonCpuRemovedMS);

$overallComparisonMuAddedB = $overallComparison['mu']['added'];
$overallComparisonMuAddedMB = $this->overrideNumberFormat($overallComparison['mu']['added'] / 1e+6, 3);
$overallComparisonMuRemovedB = $overallComparison['mu']['removed'];
$overallComparisonMuRemovedMB = $this->overrideNumberFormat($overallComparison['mu']['removed'] / 1e+6, 3);
$muPresent = $this->getParameters()['get-present']($overallComparisonMuAddedB, $overallComparisonMuRemovedB);

$overallComparisonPmuAddedB = $overallComparison['pmu']['added'];
$overallComparisonPmuAddedMB = $this->overrideNumberFormat($overallComparison['pmu']['added'] / 1e+6, 3);
$overallComparisonPmuRemovedB = $overallComparison['pmu']['removed'];
$overallComparisonPmuRemovedMB = $this->overrideNumberFormat($overallComparison['pmu']['removed'] / 1e+6, 3);
$pmuPresent = $this->getParameters()['get-present']($overallComparisonPmuAddedB, $overallComparisonPmuRemovedB);
?>

<div class="content__header">
    <h4 class="title">Result of open performance reports</h4>
</div>

<?php if ([] === $this->getParameters()['reports']): ?>
    <div class="clear-block">
        <span>
            <span class="opacity">
                No open reports.
            </span>
            <a href="<?php echo routePath(Profiler::generateRouteName(new ListPerformanceReports())); ?>">List of performance reports</a>
        </span>
    </div>
<?php else: ?>
    <div class="opened__reports">
        <?php foreach ($this->getParameters()['reports'] as $report): ?>
            <span># <span class="blue-text"><?php echo $report; ?></span></span>
        <?php endforeach; ?>
    </div>
    <div class="content__navigation">
        <ul class="content__navigation-items">
            <li class="content__navigation-item active">
                All
            </li>
            <li class="content__navigation-item <?php echo count($this->getParameters()['reports']) === 1 ? 'disabled' : null; ?>">
                Added features
            </li>
            <li class="content__navigation-item <?php echo count($this->getParameters()['reports']) === 1 ? 'disabled' : null; ?>">
                Removed features
            </li>
            <li class="content__navigation-item <?php echo count($this->getParameters()['reports']) === 1 ? 'disabled' : null; ?>">
                General numeric statistics
            </li>
        </ul>
    </div>

    <?php if (null !== $this->getParameters()['openedFunc']): ?>
        <div class="opened-function">
            <span class="mark orange"><?php echo $this->getParameters()['openedFunc']; ?></span>
        </div>
    <?php endif; ?>

    <div class="content__screen-wrap">
        <div class="content__navigation-wrap">
            <div class="scroll on-scroll">
                <table>
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Calls</th>
                        <th>Lead Time</th>
                        <th>CPU Time</th>
                        <th>Wasted memory</th>
                        <th>Peak memory usage</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (count($this->getParameters()['reports']) === 1) {
                        require $this->getPathToResource('single-performance-tr.php');
                    } else {
                        require $this->getPathToResource('compare-performance-tr.php');
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="scroll on-scroll">
                <table>
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Calls</th>
                        <th>Lead Time</th>
                        <th>CPU Time</th>
                        <th>Wasted memory</th>
                        <th>Peak memory usage</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($this->getParameters()['iteration']($this->getParameters()['compare-report-added']) as $index => $added): ?>
                        <?php foreach ($added as $functionName => $data): ?>
                            <tr class="green">
                                <td>
                                    <i class="td-plus fas fa-plus"></i>
                                    <a href="#">
                                        <?php echo $functionName; ?>
                                    </a>
                                </td>
                                <td><?php echo $data['ct']; ?></td>
                                <td>
                                    <span class="blue-text"><?php echo $this->overrideNumberFormat($data['wt'] / 1000, 3); ?> ms</span>
                                    <span class="orange-text">(<?php echo $this->overrideNumberFormat(($data['wt'] / 1000) / 1000, 3); ?> sec)</span>
                                </td>
                                <td>
                                    <span class="blue-text"><?php echo $this->overrideNumberFormat($data['cpu'] / 1000, 3); ?> ms</span>
                                    <span class="orange-text">(<?php echo $this->overrideNumberFormat(($data['cpu'] / 1000) / 1000, 3); ?> sec)</span>
                                </td>
                                <td>
                                    <span class="blue-text"><?php echo $data['mu']; ?> B</span>
                                    <span class="orange-text">(<?php echo $this->overrideNumberFormat($data['mu'] / 1e+6, 3); ?> MB)</span>
                                </td>
                                <td>
                                    <span class="blue-text"><?php echo $data['pmu']; ?> B</span>
                                    <span class="orange-text">(<?php echo $this->overrideNumberFormat($data['pmu'] / 1e+6, 3); ?> MB)</span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="scroll on-scroll">
                <table>
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Calls</th>
                        <th>Lead Time</th>
                        <th>CPU Time</th>
                        <th>Wasted memory</th>
                        <th>Peak memory usage</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($this->getParameters()['iteration']($this->getParameters()['compare-report-removed']) as $index => $removed): ?>
                        <?php foreach ($removed as $functionName => $data): ?>
                            <tr class="red">
                                <td>
                                    <i class="td-minus fas fa-minus"></i>
                                    <a href="#">
                                        <?php echo $functionName; ?>
                                    </a>
                                </td>
                                <td><?php echo $data['ct']; ?></td>
                                <td>
                                    <span class="blue-text"><?php echo $this->overrideNumberFormat($data['wt'] / 1000, 3); ?> ms</span>
                                    <span class="orange-text">(<?php echo $this->overrideNumberFormat(($data['wt'] / 1000) / 1000, 3); ?> sec)</span>
                                </td>
                                <td>
                                    <span class="blue-text"><?php echo $this->overrideNumberFormat($data['cpu'] / 1000, 3); ?> ms</span>
                                    <span class="orange-text">(<?php echo $this->overrideNumberFormat(($data['cpu'] / 1000) / 1000, 3); ?> sec)</span>
                                </td>
                                <td>
                                    <span class="blue-text"><?php echo $data['mu']; ?> B</span>
                                    <span class="orange-text">(<?php echo $this->overrideNumberFormat($data['mu'] / 1e+6, 3); ?> MB)</span>
                                </td>
                                <td>
                                    <span class="blue-text"><?php echo $data['pmu']; ?> B</span>
                                    <span class="orange-text">(<?php echo $this->overrideNumberFormat($data['pmu'] / 1e+6, 3); ?> MB)</span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div>
                <div class="statistic__block-container">
                    <div class="statistic__block">
                        <div class="statistic__block-flex">
                            <div>
                                <span class="statistic__block-title">Lead time:</span>
                                <div class="statistic__block-data">
                                    <span class="statistic__block-present"><?php echo $wtPresent; ?>%</span>
                                    <div class="statistic__block-item">
                                        <span class="square green"></span>
                                        <span class="green-text">+<?php echo $overallComparisonWtAddedMS; ?> ms
                                        <span class="orange-text">(+<?php echo $overallComparisonWtAddedS; ?> s)</span></span>
                                    </div>
                                    <div class="statistic__block-item">
                                        <span class="square red"></span>
                                        <span class="red-text"><?php echo $overallComparisonWtRemovedMS; ?> ms
                                        <span class="orange-text">(<?php echo $overallComparisonWtRemovedS; ?> s)</span></span>
                                    </div>
                                </div>
                            </div>
                            <?php echo $this->getParameters()['report-render']($overallComparisonWtAddedMS, $overallComparisonWtRemovedMS, $wtPresent); ?>
                        </div>
                    </div>
                    <div class="statistic__block">
                        <div class="statistic__block-flex">
                            <div>
                                <span class="statistic__block-title">CPU Time:</span>
                                <div class="statistic__block-data">
                                    <span class="statistic__block-present"><?php echo $cpuPresent; ?>%</span>
                                    <div class="statistic__block-item">
                                        <span class="square green"></span>
                                        <span class="green-text">+<?php echo $overallComparisonCpuAddedMS; ?> ms
                                        <span class="orange-text">(+<?php echo $overallComparisonCpuAddedS; ?> s)</span></span>
                                    </div>
                                    <div class="statistic__block-item">
                                        <span class="square red"></span>
                                        <span class="red-text"><?php echo $overallComparisonCpuRemovedMS; ?> ms
                                        <span class="orange-text">(<?php echo $overallComparisonCpuRemovedS; ?> s)</span></span>
                                    </div>
                                </div>
                            </div>
                            <?php echo $this->getParameters()['report-render']($overallComparisonCpuAddedMS, $overallComparisonCpuRemovedMS, $cpuPresent); ?>
                        </div>
                    </div>
                    <div class="statistic__block">
                        <div class="statistic__block-flex">
                            <div>
                                <span class="statistic__block-title">Wasted memory:</span>
                                <div class="statistic__block-data">
                                    <span class="statistic__block-present"><?php echo $muPresent; ?>%</span>
                                    <div class="statistic__block-item">
                                        <span class="square green"></span>
                                        <span class="green-text">+<?php echo $overallComparisonMuAddedB; ?> B
                                        <span class="orange-text">(+<?php echo $overallComparisonMuAddedMB; ?> MB)</span></span>
                                    </div>
                                    <div class="statistic__block-item">
                                        <span class="square red"></span>
                                        <span class="red-text"><?php echo $overallComparisonMuRemovedB; ?> B
                                        <span class="orange-text">(<?php echo $overallComparisonMuRemovedMB; ?> MB)</span></span>
                                    </div>
                                </div>
                            </div>
                            <?php echo $this->getParameters()['report-render']($overallComparisonMuAddedB, $overallComparisonMuRemovedB, $muPresent); ?>
                        </div>
                    </div>
                    <div class="statistic__block">
                        <div class="statistic__block-flex">
                            <div>
                                <span class="statistic__block-title">Peak memory usage:</span>
                                <div class="statistic__block-data">
                                    <span class="statistic__block-present"><?php echo $pmuPresent; ?>%</span>
                                    <div class="statistic__block-item">
                                        <span class="square green"></span>
                                        <span class="green-text">+<?php echo $overallComparisonPmuAddedB; ?> B
                                        <span class="orange-text">(+<?php echo $overallComparisonPmuAddedMB; ?> MB)</span></span>
                                    </div>
                                    <div class="statistic__block-item">
                                        <span class="red-text"><?php echo $overallComparisonPmuRemovedB; ?> B
                                        <span class="orange-text">(<?php echo $overallComparisonPmuRemovedMB; ?> MB)</span></span>
                                    </div>
                                </div>
                            </div>
                            <?php echo $this->getParameters()['report-render']($overallComparisonPmuAddedB, $overallComparisonPmuRemovedB, $pmuPresent); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<style>
    .opened__reports {
        padding: var(--gutter);
        display: flex;
        flex-flow: column;
    }

    .opened__reports > span {
        display: block;
        margin-bottom: 5px;
    }

    tr.green {
        background: #12f91230;
    }

    tr.red {
        background: #f9121230;
    }

    table > tbody td {
        padding: 10px 15px;
    }

    .td-plus, .td-minus {
        margin-right: 10px;
    }

    .td-plus {
        color: #02ff14;
    }

    .td-minus {
        color: #ff3636;
    }

    td > div.flex > div:first-of-type {
        margin-right: 7px;
    }

    .statistic__block-data {
        display: flex;
        flex-flow: column;
        margin-left: 15px;
        position: relative;
        width: max-content;
    }

    .statistic__block-present {
        position: absolute;
        right: -95px;
        top: 25%;
        color: var(--accent);
    }

    .statistic__block-data:after {
        content: '';
        position: absolute;
        right: -42px;
        height: 85%;
        border-top: 1px dashed var(--light-border);
        border-bottom: 1px dashed var(--light-border);
        border-right: 1px dashed var(--light-border);
        padding: 0 17px;
        top: -10px;
    }

    .statistic__block-item {
        display: flex;
        margin-bottom: 40px;
        align-items: center;
    }

    .statistic__block-item > span.square {
        margin-right: 10px;
    }

    .statistic__block-title {
        margin-bottom: 7px;
        opacity: 0.7;
        display: block;
    }

    .statistic__block-flex {
        display: flex;
        justify-content: space-between;
        background: var(--light-bg);
        padding: 15px;
        border-bottom: 3px solid var(--light-border);
    }

    .end__report {
        display: flex;
        align-items: center;
        padding: 15px 16px;
        border-radius: 6px;
        height: max-content;
        margin: auto 0;
    }

    .end__report.orange {
        background: #ffa5002e;
        border: 1px dashed orange;
    }

    .end__report.green {
        background: #00ff2b2e;
        border: 1px dashed #27ff00;
    }

    .end__report.red {
        background: #ff00002e;
        border: 1px dashed #ff0000;
    }

    .report__message {
        margin-left: 10px;
    }

    .opened-function {
        margin: var(--gutter);
        position: relative;
        width: max-content;
        margin-top: 50px;
    }

    .opened-function > span {
        display: block;
        margin: 0 10px;
        width: max-content;
    }

    .opened-function:before {
        content: '';
        width: 2px;
        height: 37px;
        background: var(--light-border);
        position: absolute;
        left: 50%;
        top: 27px;
    }
</style>
<script type="application/javascript" src="<?php echo $this->getRecourseInBase('js/ResizeSensor.js'); ?>"></script>