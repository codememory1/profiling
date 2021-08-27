<?php

use Codememory\Components\GlobalConfig\GlobalConfig;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Codememory Profiler</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="shortcut icon" href="<?php echo $this->getRecourseInBase('images/codememory_icon.png'); ?>"
          type="image/png">
    <link rel="stylesheet" href="<?php echo $this->getRecourseInBase('css/basic.css'); ?>">
</head>
<body>
<div class="notifications"></div>

<header class="header">
    <div class="header__left">
        <div class="header__logo">
            <a href="<?php echo routePath('__profiler-PerformanceSection'); ?>">
                <img src="<?php echo $this->getRecourseInBase('images/codememory-white.svg'); ?>"
                     alt="Codememory profiler">
                <span class="context-logo">Profiler</span>
            </a>
        </div>
    </div>
    <div class="header__right">
        <div class="cdm-version version-wrap">
            Codememory: <span class="version">v<?php echo GlobalConfig::get('version'); ?></span>
        </div>
        <div class="php-version version-wrap">
            PHP: <span class="version"><?php echo phpversion(); ?></span>
        </div>
        <div class="selection-theme">
            <select class="list-themes">
                <option value="light-theme">Light theme</option>
                <option value="blue-theme">Blue theme</option>
                <option value="dark-theme">Dark theme</option>
            </select>
        </div>
    </div>
</header>

<main class="main">
    <?php require_once $this->getPathToResource('navigation.php'); ?>

    <div class="content">
        <?php eval('?>'.$this->getContent()); ?>
    </div>
</main>

<script type="application/javascript" src="<?php echo $this->getRecourseInBase('js/basic.js'); ?>"></script>
</body>
</html>