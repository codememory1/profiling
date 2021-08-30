<?php

use Codememory\Components\Profiling\Profiler;

?>
<div class="navigation">
    <div class="navigation__btn">
        <i class="fas fa-bars"></i>
    </div>
    <ul class="navigation__items">
        <?php foreach (Profiler::getSections() as $section): ?>
            <li class="navigation__item">
                <a href="<?php echo $this->getRoutePath($section::class); ?>">
                    <?php echo $section->getIcon(); ?>
                    <span>
                        <?php echo $section->getName(); ?>
                    </span>
                </a>
                <?php if ([] !== $section->getSubsections()): ?>
                    <ul class="navigation__items">
                        <?php foreach ($section->getSubsections() as $subsection): ?>
                            <li class="navigation__item">
                                <a href="<?php echo $this->getRoutePath($subsection::class); ?>">
                                    <?php echo $subsection->getName(); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>