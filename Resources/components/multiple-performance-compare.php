<?php
$withdrawn = 0;

$report = $this->getParameter('sort-report')($this->getParameter('report')['report'], 'wt');

foreach ($this->getParameter('iteration')($report) as $functionName => $data) {
    if (null !== $data['ct']['added']) {
        $ct = sprintf('<span class="red-text">+%s</span>', $data['ct']['added']);
    } else {
        $ct = sprintf('<span class="green-text">%s</span>', $data['ct']['removed']);
    }

    if (null !== $data['wt']['added']) {
        $wt = sprintf('
        <div>
            <span class="red-text">+%s ms</span>
            <br>
            <span class="red-text">+%s s</span>
        </div>
        ', $this->overrideNumberFormat($data['wt']['added'] / 1000, 3), $this->overrideNumberFormat(($data['wt']['added'] / 1000) / 1000, 3));
    } else {
        $wt = sprintf('
        <div>
            <span class="green-text">%s ms</span>
            <br>
            <span class="green-text">%s s</span>
        </div>
        ', $this->overrideNumberFormat($data['wt']['removed'] / 1000, 3), $this->overrideNumberFormat(($data['wt']['removed'] / 1000) / 1000, 3));
    }

    if (null !== $data['cpu']['added']) {
        $cpu = sprintf('
        <div>
            <span class="red-text">+%s ms</span>
            <br>
            <span class="red-text">+%s s</span>
        </div>
        ', $this->overrideNumberFormat($data['cpu']['added'] / 1000, 3), $this->overrideNumberFormat(($data['cpu']['added'] / 1000) / 1000, 3));
    } else {
        $cpu = sprintf('
        <div>
            <span class="green-text">%s ms</span>
            <br>
            <span class="green-text">%s s</span>
        </div>
        ', $this->overrideNumberFormat($data['cpu']['removed'] / 1000, 3), $this->overrideNumberFormat(($data['cpu']['removed'] / 1000) / 1000, 3));
    }

    if (null !== $data['mu']['added']) {
        $mu = sprintf('
        <div>
            <span class="red-text">+%s B</span> <br>
            <span class="red-text">+%s MB</span>
        </div>
        ', $data['mu']['added'], $this->overrideNumberFormat($data['mu']['added'] / 1e+6, 3));
    } else {
        $mu = sprintf('
        <div>
            <span class="green-text">%s B</span> <br>
            <span class="green-text">%s MB</span>
        </div>
        ', $data['mu']['removed'], $this->overrideNumberFormat($data['mu']['removed'] / 1e+6, 3));
    }

    if (null !== $data['pmu']['added']) {
        $pmu = sprintf('
        <div>
            <span class="red-text">+%s B</span> <br>
            <span class="red-text">+%s MB</span>
        </div>
        ', $data['pmu']['added'], $this->overrideNumberFormat($data['pmu']['added'] / 1e+6, 3));
    } else {
        $pmu = sprintf('
        <div>
            <span class="green-text">%s B</span> <br>
            <span class="green-text">%s MB</span>
        </div>
        ', $data['pmu']['removed'], $this->overrideNumberFormat($data['pmu']['removed'] / 1e+6, 3));
    }

    $tr = <<<TR
    <tr style="%s">
        <td>
            <a href="">$functionName</a>
        </td>
        <td>
            {$data['ct']['was']}
            $ct
        </td>
        <td>
            <div class="flex">
                <div>
                    <span class="blue-text">{$this->overrideNumberFormat($data['wt']['was'] / 1000, 3)} ms</span><br>
                    <span class="orange-text">({$this->overrideNumberFormat(($data['wt']['was'] / 1000) / 1000, 3)} s)</span>
                </div>
                $wt
            </div>
        </td>
        <td>
            <div class="flex">
                <div>
                    <span class="blue-text">{$this->overrideNumberFormat($data['cpu']['was'] / 1000, 3)} ms</span><br>
                    <span class="orange-text">({$this->overrideNumberFormat(($data['cpu']['was'] / 1000) / 1000, 3)} s)</span>
                </div>
                $cpu
            </div>
        </td>
        <td>
            <div class="flex">
                <div>
                    <span class="blue-text">{$data['mu']['was']} B</span><br>
                    <span class="orange-text">({$this->overrideNumberFormat($data['mu']['was'] / 1e+6, 3)} MB)</span>
                </div>
                $mu
            </div>
        </td>
        <td>
            <div class="flex">
                <div>
                    <span class="blue-text">{$data['pmu']['was']} B</span><br>
                    <span class="orange-text">({$this->overrideNumberFormat($data['pmu']['was'] / 1e+6, 3)} MB)</span>
                </div>
                $pmu
            </div>
        </td>
    </tr>
    TR;

    if ($withdrawn >= 10) {
        echo sprintf($tr, 'display: none');
    } else {
        echo sprintf($tr, '');
    }

    $withdrawn++;
}
