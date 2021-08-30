<?php

use Codememory\Components\Profiling\DateFormatter;
use Codememory\Components\Profiling\Sections\Subsections\PerformanceReportResultSection;

?>

<div class="content__header">
    <h4 class="title">Compare profiling hashes</h4>
</div>

<div class="compare-wrap">
    <div class="compare-inner">
        <div class="compare-label">
            <span>List of available hashes:</span>
        </div>
        <div class="list__hashes scroll">
            <?php foreach ($this->getParameter('reports') as $report): ?>
                <div class="profiling__hash">
                <span data-value="<?php echo $report->getHash(); ?>">
                    # <span class="blue-text"><?php echo $report->getHash(); ?></span>
                    <span class="yellow-text">(<?php echo DateFormatter::format($report->getCreated(), $this->getParameter('now-time')); ?> age)</span>
                </span>
                    <div class="actions__hash">
                        <span class="add-hash"><i class="fas fa-plus"></i></span>
                        <span class="remove-hash hide"><i class="fas fa-minus"></i></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="compare-inner">
        <div class="compare-label">
            <span>Selected hashes for comparison:</span>
        </div>
        <div class="compare-input__hashes scroll"></div>
    </div>
</div>

<a href="<?php echo $this->getRoutePath(PerformanceReportResultSection::class); ?>" class="mark green btn btn__compare">Compare</a>

<style>
    .compare-wrap {
        display: flex;
        margin: var(--gutter);
    }

    .compare-label span {
        font-size: 15px;
        opacity: 0.7;
        display: block;
        margin-bottom: 7px;
    }

    .compare-inner {
        width: 100%;
        margin: 0 10px;
    }

    .compare-input__hashes {
        border: 1px solid var(--light-border);
        height: 110px;
        border-radius: 5px;
        width: 100%;
        display: flex;
        flex-flow: wrap;
        align-content: flex-start;
        overflow: auto;
    }

    .list__hashes {
        width: 100%;
        display: flex;
        flex-flow: column;
        border: 1px solid var(--light-border);
        border-radius: 5px;
        height: 110px;
        overflow: auto;
    }

    .profiling__hash {
        padding: 2px 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .profiling__hash:nth-child(2n) {
        background: var(--light-bg);
    }

    .actions__hash > span {
        font-size: 12px;
        transition: background 0.2s;
        margin: 5px 0;
        display: block;
    }

    .actions__hash > span:active {
        opacity: 0.7;
    }

    .add-hash {
        background: green;
        padding: 3px 5px;
        border-radius: 3px;
        cursor: pointer;
    }

    .remove-hash {
        background: #bb3030;
        padding: 3px 5px;
        border-radius: 3px;
        cursor: pointer;
    }

    .actions__hash > span.hide {
        display: none;
    }

    .profiling__hash > span {
        font-size: 14px;
    }

    .selected__hash {
        background: var(--light-bg);
        font-size: 13px;
        padding: 3px 4px;
        border-radius: 3px;
        margin: 4px 4px;
        width: max-content;
        height: max-content;
        display: flex;
        align-items: center;
    }

    .selected__hash > span {
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 88px;
    }

    .selected__hash > i {
        margin-right: 5px;
        opacity: 0.5;
        cursor: pointer;
    }

    .selected__hash > i:hover {
        opacity: 0.3;
    }

    .btn__compare {
        margin-left: var(--gutter);
    }
</style>