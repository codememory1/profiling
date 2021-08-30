<div class="content__header">
    <h4 class="title">Result of open performance reports</h4>
</div>

<div class="cards">
    <?php foreach ($this->getParameter('opened-hashes') as $openedHash): ?>
        <?php foreach ($this->getParameter('full-reports') as $fullReport): ?>
            <?php if($openedHash === $fullReport->getHash()): ?>
                <div class="card">
                    <span class="card-title">Loading the page</span>
                    <div class="card-content">
                        <i class="green-text fas fa-check"></i>
                        <span class="card-content__text"><?php echo $fullReport->getLeadTime(); ?> ms</span>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>

<?php
    $report = $this->getParameter('report');

    if(array_key_exists('report', $report) && is_array($report['report'])) {
        require_once $this->getResource()->getPath('views/performance-compare-result.php');
    } else {
        require_once $this->getResource()->getPath('views/performance-report-result_without-compare.php');
    }
?>
<style>
    .cards {
        display: flex;
        flex-flow: wrap;
    }

    .card {
        background: var(--light-bg);
        width: 170px;
        height: 100px;
        border-radius: 5px;
        border: 1px solid var(--light-border);
        margin: 0 20px;
    }

    .card-title {
        opacity: 0.7;
        font-size: 14px;
        padding: 7px 0;
        border-bottom: 1px solid var(--light-border);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card-content {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 43px;
    }

    .card-content > i {
        font-size: 25px;
    }

    .card-content__text {
        font-size: 20px;
        margin-left: 10px;
    }

    .load-hidden-tr {
        display: flex;
        justify-content: center;
    }

    .load-hidden-tr > span {
        background: var(--accent);
        padding: 5px 15px;
        border-radius: 3px;
        cursor: pointer;
        margin-top: 30px;
        transition: opacity 0.3s;
    }

    .load-hidden-tr > span:hover {
        opacity: 0.8;
    }
</style>
