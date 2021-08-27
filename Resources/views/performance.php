<?php
    use Codememory\Components\Profiling\ProfilerSection;
    use Codememory\Components\Profiling\Profiler;
?>
<div class="content__header">
    <h4 class="title">Performance links</h4>
<!--    <a href="--><?php //echo $this->getParameters()['referer']; ?><!--" class="come-back"><i class="fal fa-long-arrow-left"></i> Back</a>-->
</div>
<ul class="performance__links">
    <?php foreach (ProfilerSection::getSection('Page performance')['subsections'] as $section): ?>
        <li class="performance__link">
            <a href="<?php echo routePath(Profiler::generateRouteName($section)); ?>"><?php echo $section->getSectionName(); ?></a>
        </li>
    <?php endforeach; ?>
</ul>

<style>
    .performance__title {
        padding: var(--gutter);
        display: block;
        border-bottom: 1px solid var(--light-border);
        margin-bottom: 10px;
    }

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