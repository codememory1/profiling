<?php
$withdrawn = 0;

$report = $this->getParameter('sort-report')($this->getParameter('report'), 'wt');

foreach ($this->getParameter('iteration')($report) as $functionName => $data) {
    $tr = <<<TR
    <tr style="%s">
        <td>
            <a href="{$this->getParameter('url-builder')(['function' => $functionName])}">
                {$functionName}
            </a>
        </td>
        <td>{$data['ct']}</td>
        <td>
            <span class="blue-text">{$this->overrideNumberFormat($data['wt'] / 1000, 3)} ms</span>
            <span class="orange-text">({$this->overrideNumberFormat(($data['wt'] / 1000) / 1000, 3)} s)</span>
        </td>
        <td>
            <span class="blue-text">{$this->overrideNumberFormat($data['cpu'] / 1000, 3)} ms</span>
            <span class="orange-text">({$this->overrideNumberFormat(($data['cpu'] / 1000) / 1000, 3)} s)</span>
        </td>
        <td>
            <span class="blue-text">{$data['mu']} B</span>
            <span class="orange-text">({$this->overrideNumberFormat($data['mu'] / 1e+6, 3)} MB)</span>
        </td>
        <td>
            <span class="blue-text">{$data['pmu']} B</span>
            <span class="orange-text">({$this->overrideNumberFormat($data['pmu'] / 1e+6, 3)} MB)</span>
        </td>
    </tr>
    TR;

    if ($withdrawn >= 10) {
        echo sprintf($tr, 'display: none');
    } else {
        echo $tr;
    }

    $withdrawn++;
}
?>
