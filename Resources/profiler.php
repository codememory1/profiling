<?php

use Codememory\Components\GlobalConfig\GlobalConfig;
use Codememory\Components\Profiling\Sections\HomeSection;

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Codememory Profiler</title>
    <link rel="shortcut icon"
          href="<?php echo $this->getResource()->getResourceInBase64('images/codememory_icon.png'); ?>"
          type="image/png">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="<?php echo $this->getResource()->getResourceInBase64('css/fa.css'); ?>">
    <link rel="stylesheet" href="<?php echo $this->getResource()->getResourceInBase64('css/profiler.css'); ?>">
</head>
<body>
<div class="notifications"></div>

<header class="header">
    <div class="header__left">
        <div class="header__logo">
            <a href="<?php $this->getRoutePath(HomeSection::class); ?>">
                <img src="<?php echo $this->getResource()->getResourceInBase64('images/codememory_white.svg'); ?>"
                     alt="Codememory profiler">
                <span class="context-logo">Profiler</span>
            </a>
        </div>
    </div>
    <div class="header__right">
        <div class="cdm-version version-wrap">
            Codememory: <span class="version">v<?php echo GlobalConfig::get('version') ?: '?'; ?></span>
        </div>
        <div class="php-version version-wrap">
            PHP: <span class="version"><?php echo phpversion(); ?></span>
        </div>
        <div class="selection-theme">
            <select class="list-themes">
                <option value="blue-theme">Blue theme</option>
                <option value="dark-theme">Dark theme</option>
            </select>
        </div>
    </div>
</header>

<main class="main">
    <?php require_once $this->getResource()->getPath('components/navigation-profiler.php'); ?>

    <div class="content scroll">
        <?php $this->contentRender(); ?>
    </div>
</main>

<script type="application/javascript"
        src="<?php echo $this->getResource()->getResourceInBase64('js/profiler.js'); ?>"></script>
</body>
</html>