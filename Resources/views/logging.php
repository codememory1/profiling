<div class="content__header">
    <h4 class="title">List of logs</h4>
</div>

<div class="content__navigation">
    <ul class="content__navigation-items">
        <li class="content__navigation-item active">
            All
        </li>
        <li class="content__navigation-item">
            Error
        </li>
        <li class="content__navigation-item">
            Debug
        </li>
        <li class="content__navigation-item">
            Warning
        </li>
        <li class="content__navigation-item">
            Notice
        </li>
        <li class="content__navigation-item">
            Alert
        </li>
    </ul>
</div>

<div class="content__screen-wrap">
    <div class="content__navigation-wrap">
        <div class="scroll on-scroll">
            <table>
                <thead>
                <tr>
                    <th>Demanded</th>
                    <th>Level</th>
                    <th>Message</th>
                    <th>Context</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->getParameters()['allLogs'] as $log): ?>
                    <tr>
                        <td>
                            <span class="mark blue"><?php echo $log['demandedClass']; ?></span>
                            <span class="mark red"><?php echo $log['demandedMethod']; ?></span>
                        </td>
                        <td>
                            <span class="mark <?php echo $this->getParameters()['classLevel']($log['level']); ?>"><?php echo $log['level']; ?></span>
                        </td>
                        <td>
                            <?php echo $log['message']; ?>
                        </td>
                        <td>
                            <?php echo $log['context']; ?>
                        </td>
                        <td>
                            <?php echo $log['date']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="scroll on-scroll">
            <table>
                <thead>
                <tr>
                    <th>Demanded</th>
                    <th>Level</th>
                    <th>Message</th>
                    <th>Context</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->getParameters()['errorLogs'] as $log): ?>
                    <tr>
                        <td>
                            <span class="mark blue"><?php echo $log['demandedClass']; ?></span>
                            <span class="mark red"><?php echo $log['demandedMethod']; ?></span>
                        </td>
                        <td>
                            <span class="mark <?php echo $this->getParameters()['classLevel']($log['level']); ?>"><?php echo $log['level']; ?></span>
                        </td>
                        <td>
                            <?php echo $log['message']; ?>
                        </td>
                        <td>
                            <?php echo $log['context']; ?>
                        </td>
                        <td>
                            <?php echo $log['date']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="scroll on-scroll">
            <table>
                <thead>
                <tr>
                    <th>Demanded</th>
                    <th>Level</th>
                    <th>Message</th>
                    <th>Context</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->getParameters()['debugLogs'] as $log): ?>
                    <tr>
                        <td>
                            <span class="mark blue"><?php echo $log['demandedClass']; ?></span>
                            <span class="mark red"><?php echo $log['demandedMethod']; ?></span>
                        </td>
                        <td>
                            <span class="mark <?php echo $this->getParameters()['classLevel']($log['level']); ?>"><?php echo $log['level']; ?></span>
                        </td>
                        <td>
                            <?php echo $log['message']; ?>
                        </td>
                        <td>
                            <?php echo $log['context']; ?>
                        </td>
                        <td>
                            <?php echo $log['date']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="scroll on-scroll">
            <table>
                <thead>
                <tr>
                    <th>Demanded</th>
                    <th>Level</th>
                    <th>Message</th>
                    <th>Context</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->getParameters()['warningLogs'] as $log): ?>
                    <tr>
                        <td>
                            <span class="mark blue"><?php echo $log['demandedClass']; ?></span>
                            <span class="mark red"><?php echo $log['demandedMethod']; ?></span>
                        </td>
                        <td>
                            <span class="mark <?php echo $this->getParameters()['classLevel']($log['level']); ?>"><?php echo $log['level']; ?></span>
                        </td>
                        <td>
                            <?php echo $log['message']; ?>
                        </td>
                        <td>
                            <?php echo $log['context']; ?>
                        </td>
                        <td>
                            <?php echo $log['date']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="scroll on-scroll">
            <table>
                <thead>
                <tr>
                    <th>Demanded</th>
                    <th>Level</th>
                    <th>Message</th>
                    <th>Context</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->getParameters()['noticeLogs'] as $log): ?>
                    <tr>
                        <td>
                            <span class="mark blue"><?php echo $log['demandedClass']; ?></span>
                            <span class="mark red"><?php echo $log['demandedMethod']; ?></span>
                        </td>
                        <td>
                            <span class="mark <?php echo $this->getParameters()['classLevel']($log['level']); ?>"><?php echo $log['level']; ?></span>
                        </td>
                        <td>
                            <?php echo $log['message']; ?>
                        </td>
                        <td>
                            <?php echo $log['context']; ?>
                        </td>
                        <td>
                            <?php echo $log['date']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="scroll on-scroll">
            <table>
                <thead>
                <tr>
                    <th>Demanded</th>
                    <th>Level</th>
                    <th>Message</th>
                    <th>Context</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->getParameters()['alertLogs'] as $log): ?>
                    <tr>
                        <td>
                            <span class="mark blue"><?php echo $log['demandedClass']; ?></span>
                            <span class="mark red"><?php echo $log['demandedMethod']; ?></span>
                        </td>
                        <td>
                            <span class="mark <?php echo $this->getParameters()['classLevel']($log['level']); ?>"><?php echo $log['level']; ?></span>
                        </td>
                        <td>
                            <?php echo $log['message']; ?>
                        </td>
                        <td>
                            <?php echo $log['context']; ?>
                        </td>
                        <td>
                            <?php echo $log['date']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>