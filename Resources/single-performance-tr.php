<?php foreach ($this->getParameters()['iteration']($this->getParameters()['functions']) as $functionName => $data): ?>
    <tr>
        <td>
            <a href="<?php echo $this->getParameters()['urlBuilder'](['function' => $functionName]); ?>">
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