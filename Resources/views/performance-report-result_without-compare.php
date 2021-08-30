<?php

use Codememory\Components\Profiling\Sections\Subsections\PerformanceListReportsSection;

?>

<?php if ([] === $this->getParameter('opened-hashes')): ?>
    <div class="clear-block">
        <span>
            <span class="opacity">
                No open reports.
            </span>
            <a href="<?php echo $this->getRoutePath(PerformanceListReportsSection::class); ?>">List of performance reports</a>
        </span>
    </div>
<?php else: ?>
    <div class="opened__reports">
        <?php foreach ($this->getParameter('opened-hashes') as $openedHash): ?>
            <span># <span class="blue-text"><?php echo $openedHash; ?></span></span>
        <?php endforeach; ?>
    </div>
    <div class="content__navigation">
        <ul class="content__navigation-items">
            <li class="content__navigation-item active">
                All
            </li>
            <li class="content__navigation-item disabled">
                Added features
            </li>
            <li class="content__navigation-item disabled">
                Removed features
            </li>
            <li class="content__navigation-item disabled">
                General numeric statistics
            </li>
        </ul>
    </div>

    <?php if (null !== $this->getParameter('opened-function')): ?>
        <div class="opened-function">
            <span class="mark orange"><?php echo $this->getParameter('opened-function'); ?></span>
        </div>
    <?php endif; ?>

    <div class="content__screen-wrap">
        <div class="content__navigation-wrap">
            <div class="scroll on-scroll">
                <table class="xhprof_table">
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
                    require $this->getResource()->getPath('components/single-performance-compare.php');
                    ?>
                    </tbody>
                </table>
                <div class="load-hidden-tr" data-load-table="xhprof_table">
                    <span>Load more</span>
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

    .hide-function {
        display: none;
    }
</style>