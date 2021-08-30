<?php

use Codememory\Components\Profiling\DateFormatter;

?>

<p class="profiler__text">
    This is the profilers home page. With this profiler, you can track each of your actions on one page
</p>
<?php if ([] === $this->getParameter('profiledPages')): ?>
    <div class="clear-block">
        <span>No statistics. Enable profiler and refresh the page you want to profile</span>
    </div>
<?php else: ?>
    <div class="profiler-wrap">
        <a href="<?php echo routePath('__cdm-profiler-remove-statistic'); ?>" class="mark red btn btn-clear"><i
                class="fas fa-trash-alt"></i> Clear all statistics</a>
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Route</th>
                <th>Method</th>
                <th>Controller</th>
                <th>Created/Modified</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($this->getParameter('profiledPages') as $key => $profiledPage): ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $profiledPage['route']; ?></td>
                    <td>
                        <span class="mark <?php echo $this->getParameter('http-method-class')($profiledPage['http-method']); ?>">
                        <?php echo $profiledPage['http-method']; ?></span>
                    </td>
                    <td>
                        <span class="mark blue"><?php echo $profiledPage['controller']; ?></span>
                        <span class="mark red"><?php echo $profiledPage['controller-method']; ?></span>
                    </td>
                    <td>
                        <?php echo $profiledPage['created']; ?> <br>
                        <span class="yellow-text">(<?php echo DateFormatter::format($profiledPage['created'], $this->getParameter('now-time')) ?> age)</span>
                    </td>
                    <td>
                        <a href="#" data-id="<?php echo $profiledPage['route']; ?>"
                           class="btn light btn__active-statistic">Activate</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<style>
    .profiler__text {
        padding: var(--gutter);
    }

    .profiler-wrap {
        margin: var(--gutter);
    }

    .btn-clear {
        float: right;
        margin-bottom: 10px;
    }

    .btn-clear > i {
        margin-right: 5px;
        font-size: 14px;
    }
</style>