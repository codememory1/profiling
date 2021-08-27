<?php foreach ($this->getParameters()['iteration']($this->getParameters()['compare-report']) as $functionName => $data): ?>
    <tr>
        <td>
            <a href=""><?php echo $functionName; ?></a>
        </td>
        <td>
            <?php echo $data['ct']['was']; ?>
            <?php if (null !== $data['ct']['added']): ?>
                <span class="green-text">+<?php echo $data['ct']['added']; ?></span>
            <?php elseif (null !== $data['ct']['removed']): ?>
                <span class="red-text">+<?php echo $data['ct']['removed']; ?></span>
            <?php endif; ?>
        </td>
        <td>
            <div class="flex">
                <div>
                    <span class="blue-text"><?php echo $this->overrideNumberFormat($data['wt']['was'] / 1000, 3); ?> ms</span><br>
                    <span class="orange-text">(<?php echo $this->overrideNumberFormat(($data['wt']['was'] / 1000) / 1000, 3); ?> sec)</span>
                </div>
                <?php if (null !== $data['wt']['added']): ?>
                    <div>
                        <span class="green-text">+<?php echo $this->overrideNumberFormat($data['wt']['added'] / 1000, 3); ?> ms</span>
                        <br>
                        <span class="green-text">+<?php echo $this->overrideNumberFormat(($data['wt']['added'] / 1000) / 1000, 3); ?> s</span>
                    </div>
                <?php elseif (null !== $data['wt']['removed']): ?>
                    <div>
                        <span class="red-text"><?php echo $this->overrideNumberFormat($data['wt']['removed'] / 1000, 3); ?> ms</span>
                        <br>
                        <span class="red-text"><?php echo $this->overrideNumberFormat(($data['wt']['removed'] / 1000) / 1000, 3); ?> s</span>
                    </div>
                <?php endif; ?>
            </div>
        </td>
        <td>
            <div class="flex">
                <div>
                    <span class="blue-text"><?php echo $this->overrideNumberFormat($data['cpu']['was'] / 1000, 3); ?> ms</span><br>
                    <span class="orange-text">(<?php echo $this->overrideNumberFormat(($data['cpu']['was'] / 1000) / 1000, 3); ?> sec)</span>
                </div>
                <?php if (null !== $data['cpu']['added']): ?>
                    <div>
                        <span class="green-text">+<?php echo $this->overrideNumberFormat($data['cpu']['added'] / 1000, 3); ?> ms</span>
                        <br>
                        <span class="green-text">+<?php echo $this->overrideNumberFormat(($data['cpu']['added'] / 1000) / 1000, 3); ?> s</span>
                    </div>
                <?php elseif (null !== $data['cpu']['removed']): ?>
                    <div>
                        <span class="red-text"><?php echo $this->overrideNumberFormat($data['cpu']['removed'] / 1000, 3); ?> ms</span>
                        <br>
                        <span class="red-text"><?php echo $this->overrideNumberFormat(($data['cpu']['removed'] / 1000) / 1000, 3); ?> s</span>
                    </div>
                <?php endif; ?>
            </div>
        </td>
        <td>
            <div class="flex">
                <div>
                    <span class="blue-text"><?php echo $data['mu']['was']; ?> B</span><br>
                    <span class="orange-text">(<?php echo $this->overrideNumberFormat($data['mu']['was'] / 1e+6, 3); ?> MB)</span>
                </div>
                <?php if (null !== $data['mu']['added']): ?>
                    <div>
                        <span class="green-text">+<?php echo $data['mu']['added']; ?> B</span> <br>
                        <span class="green-text">+<?php echo $this->overrideNumberFormat($data['mu']['added'] / 1e+6, 3); ?> MB</span>
                    </div>
                <?php elseif (null !== $data['mu']['removed']): ?>
                    <div>
                        <span class="red-text"><?php echo $data['mu']['removed']; ?> B</span> <br>
                        <span class="red-text"><?php echo $this->overrideNumberFormat($data['mu']['removed'] / 1e+6, 3); ?> MB</span>
                    </div>
                <?php endif; ?>
            </div>
        </td>
        <td>
            <div class="flex">
                <div>
                    <span class="blue-text"><?php echo $data['pmu']['was']; ?> B</span><br>
                    <span class="orange-text">(<?php echo $this->overrideNumberFormat($data['pmu']['was'] / 1e+6, 3); ?> MB)</span>
                </div>
                <?php if (null !== $data['pmu']['added']): ?>
                    <div>
                        <span class="green-text">+<?php echo $data['pmu']['added']; ?> B</span> <br>
                        <span class="green-text">+<?php echo $this->overrideNumberFormat($data['pmu']['added'] / 1e+6, 3); ?> MB</span>
                    </div>
                <?php elseif (null !== $data['pmu']['removed']): ?>
                    <div>
                        <span class="red-text"><?php echo $data['pmu']['removed']; ?> B</span> <br>
                        <span class="red-text"><?php echo $this->overrideNumberFormat($data['pmu']['removed'] / 1e+6, 3); ?> MB</span>
                    </div>
                <?php endif; ?>
            </div>
        </td>
    </tr>
<?php endforeach; ?>
