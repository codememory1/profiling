<?php

use Codememory\Components\Profiling\Sections\Builders\LoggingBuilder;
?>

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
                <?php foreach ($this->getParameter('logs') as $log): ?>
                    <tr>
                        <td>
                            <span class="mark blue"><?php echo $log->getDemandedClass(); ?></span>
                            <span class="mark red"><?php echo $log->getDemandedMethod(); ?></span>
                        </td>
                        <td>
                            <span class="mark <?php echo $this->getParameter('level-class')($log->getLevel()); ?>"><?php echo $log->getLevel(); ?></span>
                        </td>
                        <td>
                            <?php echo $log->getMessage(); ?>
                        </td>
                        <td>
                            <?php echo $log->getContext(); ?>
                        </td>
                        <td>
                            <?php echo $log->getCreated(); ?>
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
                <?php foreach ($this->getParameter('sort-logs')('error') as $log): ?>
                    <tr>
                        <td>
                            <span class="mark blue"><?php echo $log->getDemandedClass(); ?></span>
                            <span class="mark red"><?php echo $log->getDemandedMethod(); ?></span>
                        </td>
                        <td>
                            <span class="mark <?php echo $this->getParameter('level-class')($log->getLevel()); ?>">
                                <?php echo $log->getLevel(); ?>
                            </span>
                        </td>
                        <td>
                            <?php echo $log->getMessage(); ?>
                        </td>
                        <td>
                            <?php echo $log->getContext(); ?>
                        </td>
                        <td>
                            <?php echo $log->getCreated(); ?>
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
                <?php foreach ($this->getParameter('sort-logs')('debug') as $log): ?>
                    <tr>
                        <td>
                            <span class="mark blue"><?php echo $log->getDemandedClass(); ?></span>
                            <span class="mark red"><?php echo $log->getDemandedMethod(); ?></span>
                        </td>
                        <td>
                            <span class="mark <?php echo $this->getParameter('level-class')($log->getLevel()); ?>">
                                <?php echo $log->getLevel(); ?>
                            </span>
                        </td>
                        <td>
                            <?php echo $log->getMessage(); ?>
                        </td>
                        <td>
                            <?php echo $log->getContext(); ?>
                        </td>
                        <td>
                            <?php echo $log->getCreated(); ?>
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
                <?php foreach ($this->getParameter('sort-logs')('warning') as $log): ?>
                    <tr>
                        <td>
                            <span class="mark blue"><?php echo $log->getDemandedClass(); ?></span>
                            <span class="mark red"><?php echo $log->getDemandedMethod(); ?></span>
                        </td>
                        <td>
                            <span class="mark <?php echo $this->getParameter('level-class')($log->getLevel()); ?>">
                                <?php echo $log->getLevel(); ?>
                            </span>
                        </td>
                        <td>
                            <?php echo $log->getMessage(); ?>
                        </td>
                        <td>
                            <?php echo $log->getContext(); ?>
                        </td>
                        <td>
                            <?php echo $log->getCreated(); ?>
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
                <?php foreach ($this->getParameter('sort-logs')('notice') as $log): ?>
                    <tr>
                        <td>
                            <span class="mark blue"><?php echo $log->getDemandedClass(); ?></span>
                            <span class="mark red"><?php echo $log->getDemandedMethod(); ?></span>
                        </td>
                        <td>
                            <span class="mark <?php echo $this->getParameter('level-class')($log->getLevel()); ?>">
                                <?php echo $log->getLevel(); ?>
                            </span>
                        </td>
                        <td>
                            <?php echo $log->getMessage(); ?>
                        </td>
                        <td>
                            <?php echo $log->getContext(); ?>
                        </td>
                        <td>
                            <?php echo $log->getCreated(); ?>
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
                <?php foreach ($this->getParameter('sort-logs')('alert') as $log): ?>
                    <tr>
                        <td>
                            <span class="mark blue"><?php echo $log->getDemandedClass(); ?></span>
                            <span class="mark red"><?php echo $log->getDemandedMethod(); ?></span>
                        </td>
                        <td>
                            <span class="mark <?php echo $this->getParameter('level-class')($log->getLevel()); ?>">
                                <?php echo $log->getLevel(); ?>
                            </span>
                        </td>
                        <td>
                            <?php echo $log->getMessage(); ?>
                        </td>
                        <td>
                            <?php echo $log->getContext(); ?>
                        </td>
                        <td>
                            <?php echo $log->getCreated(); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>