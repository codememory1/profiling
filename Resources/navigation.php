<?php

use Codememory\Components\Profiling\Profiler;
use Codememory\Components\Profiling\ProfilerSection;

?>
<div class="navigation">
    <div class="navigation__btn">
        <i class="fas fa-bars"></i>
    </div>
    <ul class="navigation__items">
        <?php foreach (ProfilerSection::getSections() as $sectionData): ?>
            <li class="navigation__item">
                <a href="<?php echo routePath(Profiler::generateRouteName($sectionData['section'])); ?>">
                    <?php echo $sectionData['section']->getIcon(); ?>
                    <span>
                        <?php echo $sectionData['section']->getSectionName(); ?>
                    </span>
                </a>
                <?php if (array_key_exists('subsections', $sectionData)): ?>
                    <ul class="navigation__items">
                        <?php foreach ($sectionData['subsections'] as $section): ?>
                            <li class="navigation__item">
                                <a href="<?php echo routePath(Profiler::generateRouteName($section)); ?>">
                                    <?php echo $section->getSectionName(); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>