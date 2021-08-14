<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Codememory Profiler!</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">

    <!--My links-->
    <link rel="shortcut icon" href="./Resources/images/codememory_icon.png?v=1" type="image/x-icon">
    <link rel="stylesheet" href="./Resources/css/profiler.css?v=1">
</head>
<body class="dark-theme">

<!--Header-->
<header class="header">
    <div class="logo">
        <img src="./Resources/images/codememory-white.svg?v=1" alt="">
        <span>Profiler</span>
    </div>
    <div class="right_header">
        <div class="change_theme">
            <select>
                <option selected disabled>Change theme</option>
                <option value="dark-theme">Dark</option>
                <option value="blue-theme">Blue</option>
                <option value="light-theme">Light</option>
            </select>
        </div>
        <div class="framework-version">
            Codememory: <span class="version">v1.4</span>
        </div>
    </div>
</header>
<main class="main">
    <aside class="menu">
        <ul class="navigation">
            <li class="navigation_item">
                <div class="navigation_item-link">
                    <i class="fas fa-head-vr"></i> Profiler
                </div>
                <ul class="navigation">
                    <a href="?_cdm-profiler=list-reports">
                        <li class="navigation_item">List of reports</li>
                    </a>
                    <a href="?_cdm-profiler=create-compare">
                        <li class="navigation_item">Compare reports</li>
                    </a>
                    <a href="#">
                        <li class="navigation_item">General statistics of the report</li>
                    </a>
                </ul>
            </li>
            <li class="navigation_item">
                <div class="navigation_item-link"><i class="fas fa-road"></i> Router</div>
            </li>
            <li class="navigation_item">
                <div class="navigation_item-link"><i class="fas fa-book"></i> Log</div>
            </li>
        </ul>
    </aside>
<!--    More details-->
<!--    <div class="content">-->
<!--        <div class="profiling__header">-->
<!--            <div class="profiling_reports">-->
<!--                <div class="profiling__header-title">Opened reports:</div>-->
<!--                <div class="profiling-reports_items">-->
<!--                    --><?php
//                        $openedReports = [];
//
//                        if(isset($_GET['run-reports'])) {
//                            $openedReports = explode('@', $_GET['run-reports']);
//                        }
//                    ?>
<!--                    --><?php //foreach ($openedReports as $report): ?>
<!--                        <span>#-->
<!--                            <span class="report_id">--><?php //echo $report; ?><!--</span>-->
<!--                            <span>(2021-07-16 14:55:22)</span>-->
<!--                        </span>-->
<!--                    --><?php //endforeach; ?>
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="container_more-details">-->
<!--            <div class="wrap-more-detail">-->
<!--                <span class="more-detail_title">Name</span>-->
<!--                <span class="more-detail_value">Kernel\FrameworkBuilder::__construct</span>-->
<!--            </div>-->
<!--            <div class="wrap-more-detail">-->
<!--                <span class="more-detail_title">Calls</span>-->
<!--                <span class="more-detail_value">1 <span class="green-text">+10</span></span>-->
<!--            </div>-->
<!--            <div class="wrap-more-detail">-->
<!--                <span class="more-detail_title">Lead time</span>-->
<!--                <span class="more-detail_value">120 000 ms <span class="red-text">-16 000</span></span>-->
<!--            </div>-->
<!--            <div class="wrap-more-detail">-->
<!--                <span class="more-detail_title">Lead time CPU</span>-->
<!--                <span class="more-detail_value">120 000 ms <span class="green-text">+2 000</span></span>-->
<!--            </div>-->
<!--            <div class="wrap-more-detail">-->
<!--                <span class="more-detail_title">ICou</span>-->
<!--                <span class="more-detail_value">100.00% <span class="green-text">+0.00%</span></span>-->
<!--            </div>-->
<!--            <div class="wrap-more-detail">-->
<!--                <span class="more-detail_title">Memory used</span>-->
<!--                <span class="more-detail_value">4 000 byte <span class="red-text">-1 000</span></span>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

    <?php if(array_key_exists('_cdm-profiler', $_GET) && $_GET['_cdm-profiler'] === 'opened-report'): ?>
        <div class="content">
            <div class="profiling__header">
                <div class="profiling_reports">
                    <div class="profiling__header-title">Opened reports:</div>
                    <div class="profiling-reports_items">
                        <?php
                            $openedReports = [];

                            if(isset($_GET['run-reports'])) {
                                $openedReports = explode('@', $_GET['run-reports']);
                            }
                        ?>
                        <?php foreach ($openedReports as $report): ?>
                            <span>#
                                <span class="report_id"><?php echo $report; ?></span>
                                <span>(2021-07-16 14:55:22)</span>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="profiling__content">
                <table class="profiling_table">
                    <thead class="profiling-table_head">
                        <th>Name</th>
                        <th>Calls</th>
                        <th>Lead time</th>
                        <th>Lead time CPU</th>
                        <th>Actions</th>
                    </thead>
                    <tbody class="profiling-table_body">

                        <?php foreach ($this->getUniqueComponentNamesWithData($this->getReport($_GET['run-reports']), 'wt') as $componentName => $data): ?>
                        <tr>
                            <td><?=$componentName;?></td>
                            <td>
                                <?=$data['ct'];?>
                            </td>
                            <td>
                                <?=$data['wt'];?> ms
                            </td>
                            <td>
                                <?=$data['cpu'];?> ms
                            </td>
                            <td class="function_actions">
                                <a href="#" class="function_action green">Open</a>
                                <a href="#" class="function_action blue">More details</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>


    <?php if(array_key_exists('_cdm-profiler', $_GET) && $_GET['_cdm-profiler'] === 'create-compare'): ?>
    <div class="content">
        <div class="wrap_section-add-hash">
            <div class="wrap_sections_create-compare">
                <div class="wrap_to_column section_create-compare">
                    <span>List of added reports for comparison:</span>
                    <div class="added-reports-for-compare"></div>
                </div>
                <div class="wrap_to_column section_create-compare" style="width: 50%">
                    <span>Choose a hash of the report:</span>
                    <select class="list_reports-select">
                        <?php foreach ($this->getReports() as $hash => $data): ?>
                            <option value="<?=$hash;?>">#<?=$hash;?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <a href="#" class="btn green btn_add-report">Add hash to list</a>
            <a href="?_cdm-profiler=result-compare" class="btn blue btn_add-report btn-compare" style="margin-left: 10px">Compare reports</a>
        </div>
    </div>
    <?php endif; ?>

    <?php if(array_key_exists('_cdm-profiler', $_GET) && $_GET['_cdm-profiler'] === 'list-reports'): ?>
    <div class="content">
        <div class="list_reports">
            <table class="profiling_table">
                <thead class="profiling-table_head">
<!--                    <th>id</th>-->
                    <th>Hash</th>
<!--                    <th>Date of creation</th>-->
                    <th>Actions</th>
                </thead>
                <tbody class="profiling-table_body">
                    <?php foreach ($this->getReports() as $hash => $data): ?>
                        <tr>
<!--                            <td>2</td>-->
                            <td>
                                # <span class="blue-text"><?=$hash;?></span>
                            </td>
<!--                            <td>-->
<!--                                2021-08-08 14:55:23-->
<!--                            </td>-->
                            <td class="function_actions">
                                <a href="?_cdm-profiler=opened-report&run-reports=<?=$hash;?>" class="function_action green">Open</a>
                                <a href="#" class="function_action red">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <?php if(array_key_exists('_cdm-profiler', $_GET) && $_GET['_cdm-profiler'] === 'result-compare'): ?>
    <div class="content">
        <div class="profiling__header">
            <div class="profiling_reports">
                <div class="profiling__header-title">Opened reports:</div>
                <div class="profiling-reports_items">
                    <?php
                        $openedReports = [];

                        if(isset($_GET['run-reports'])) {
                            $openedReports = explode('@', $_GET['run-reports']);
                        }
                    ?>
                    <?php foreach ($openedReports as $report): ?>
                        <span>#
                            <span class="report_id"><?php echo $report; ?></span>
                            <span>(2021-07-16 14:55:22)</span>
                        </span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
                $diffReport = $this->diffReports($this->getReport($openedReports[0]), $this->getReport($openedReports[1]), 'wt');
                $diffReport = $this->getUniqueComponentNamesWithData($diffReport);
                $diffCommonReplaced = $this->getDiffCommonNumbers($diffReport);
            ?>
            <div class="profiling_reports">
                <div class="profiling__header-title">Sum statistics lead time:</div>
                <div class="profiling-reports_items">
                    <div class="comparison-statistics_wrap" data-comparison="*%">
                        <div class="comparison-statistics">
                            <span class="green-square"></span>
                            <span class="green-text">+<?=$diffCommonReplaced['added']['wt']; ?> ms <br>+<?=$diffCommonReplaced['added']['wt'] / 1e+6;?> s</span>
                        </div>
                        <div class="comparison-statistics">
                            <span class="red-square"></span>
                            <span class="red-text"><?=$diffCommonReplaced['removed']['wt']; ?> ms <br><?=$diffCommonReplaced['removed']['wt'] / 1e+6;?> s</span>
                        </div>
                    </div>
                    <span class="report_sum-text">Comparison report:</span>
                    <div class="comparison-statistics">
                        <span class="red-square"></span>
                        <span class="red-text">Bad result</span>
                    </div>
                </div>
            </div>
            <div class="profiling_reports">
                <div class="profiling__header-title">Sum statistics lead time CPU:</div>
                <div class="profiling-reports_items">
                    <div class="comparison-statistics_wrap" data-comparison="*%">
                        <div class="comparison-statistics">
                            <span class="green-square"></span>
                            <span class="green-text">+<?=$diffCommonReplaced['added']['cpu']; ?> ms <br>+<?=$diffCommonReplaced['added']['cpu'] / 1e+6;?> s</span>
                        </div>
                        <div class="comparison-statistics">
                            <span class="red-square"></span>
                            <span class="red-text"><?=$diffCommonReplaced['removed']['cpu']; ?> ms <br><?=$diffCommonReplaced['removed']['cpu'] / 1e+6;?> s</span>
                        </div>
                    </div>
                    <span class="report_sum-text">Comparison report:</span>
                    <div class="comparison-statistics">
                        <span class="green-square"></span>
                        <span class="green-text">Excellent result</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="profiling__content">
            <table class="profiling_table">
                <thead class="profiling-table_head">
                    <th>Name</th>
                    <th>Calls</th>
                    <th>Lead time</th>
                    <th>Lead time CPU</th>
                    <th>Actions</th>
                </thead>
                <tbody class="profiling-table_body">
                    <?php foreach ($diffReport as $hashName => $data): ?>
                    <tr>
                        <td><?=$hashName;?></td>
                        <td>
                            <?=$data['ct']['was'];?>
                            (<span class="<?=$data['ct']['changed'] <= 0 ? 'red-text' : 'green-text';?>">
                                <?=$data['ct']['changed'] < 0 ? $data['ct']['changed'] : '+'.$data['ct']['changed']; ?>
                            </span>)
                        </td>
                        <td>
                            <?=$data['wt']['was'];?>
                            (<span class="<?=$data['wt']['changed'] <= 0 ? 'red-text' : 'green-text';?>">
                                <?=$data['wt']['changed'] < 0 ? $data['wt']['changed'] : '+'.$data['wt']['changed']; ?>
                            </span>) ms
                        </td>
                        <td>
                            <?=$data['cpu']['was'];?>
                            (<span class="<?=$data['cpu']['changed'] <= 0 ? 'red-text' : 'green-text';?>">
                                <?=$data['cpu']['changed'] < 0 ? $data['cpu']['changed'] : '+'.$data['cpu']['changed']; ?>
                            </span>) ms
                        </td>
                        <td class="function_actions">
                            <a href="#" class="function_action green">Open</a>
                            <a href="#" class="function_action blue">More details</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php endif; ?>


<!--Scripts-->
<script type="application/javascript" src="./Resources/js/profiler.js?v=1"></script>
</body>
</html>