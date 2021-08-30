<?php

use Codememory\Components\Profiling\DateFormatter;
use Codememory\Components\Profiling\Sections\Subsections\PerformanceReportResultSection;
use Codememory\HttpFoundation\Client\Url;

$url = new Url();

$resultUrl = $this->getRoutePath(PerformanceReportResultSection::class);
$urlParameters = $url->getParameters($url->getUrl());
?>

<div class="content__header">
    <h4 class="title">List reports</h4>
</div>

<div class="table-wrap">
    <table class="table">
        <thead>
        <tr>
            <th>Hash</th>
            <th>Profiling date</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($this->getParameter('reports') as $report): ?>
            <tr>
                <td>
                    <span class="mark red">#</span>
                    <a href="<?php echo $url->addParameters($resultUrl, array_merge($urlParameters, ['reports' => $report->getHash()])); ?>"><?php echo $report->getHash(); ?></a>
                </td>
                <td>
                    <?php echo $report->getCreated(); ?>
                    <span class="yellow-text">(<?php echo DateFormatter::format($report->getCreated(), $this->getParameter('now-time')) ?> age)</span>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>