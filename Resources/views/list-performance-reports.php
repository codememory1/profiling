<?php

use Codememory\Components\DateTime\Time;
use Codememory\Components\Profiling\DateFormatter;
use Codememory\Components\Profiling\Profiler;
use Codememory\Components\Profiling\Sections\Subsections\PerformanceReportsResult;
use Codememory\HttpFoundation\Client\Url;

$url = new Url();

$resultUrl = routePath(Profiler::generateRouteName(new PerformanceReportsResult()));
$urlParameters = $url->getParameters($url->getUrl());
$nowTime = (new Time())->now();
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
        <?php foreach ($this->getParameters()['list-reports'] as $data): ?>
            <tr>
                <td>
                    <span class="mark red">#</span>
                    <a href="<?php echo $url->addParameters($resultUrl, array_merge($urlParameters, ['reports' => $data['hash']])); ?>"><?php echo $data['hash']; ?></a>
                </td>
                <td>
                    <?php echo $data['created']; ?>
                    <span class="yellow-text">(<?php echo DateFormatter::formatter($nowTime, strtotime($data['created'])) ?> age)</span>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>