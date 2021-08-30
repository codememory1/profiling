<?php

use Codememory\Components\Profiling\Profiler;
use Codememory\Components\Profiling\Sections\PerformanceSection;

?>
<div class="content__header">
    <h4 class="title">Performance links</h4>
</div>
<ul class="performance__links">
    <?php foreach (Profiler::getSection(PerformanceSection::class)->getSubsections() as $section): ?>
        <li class="performance__link">
            <a href="<?php echo $this->getRoutePath($section::class); ?>"><?php echo $section->getName(); ?></a>
        </li>
    <?php endforeach; ?>
</ul>

<style>
    .performance__links {
        margin-left: 60px;
    }

    .performance__link > a {
        color: var(--accent);
        text-decoration: none;
        margin-bottom: 7px;
        display: block;
    }
</style>
