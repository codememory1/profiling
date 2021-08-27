<?php

namespace Codememory\Components\Profiling;

/**
 * Class DateFormatter
 *
 * @package Codememory\Components\Profiling
 *
 * @author  Codememory
 */
class DateFormatter
{

    /**
     * @param int $current
     * @param int $with
     *
     * @return string
     */
    public static function formatter(int $current, int $with): string
    {

        $compare = $current - $with;

        if($compare < 60) {
            return sprintf('%s second', $compare);
        } else if (60 > $minute = ($compare / 60)) {
            return sprintf('%s minute', round($minute));
        } else if (24 > $hour = ($compare / 3600)) {
            return sprintf('%s hour', round($hour));
        }

        return sprintf('%s day', number_format($compare / 86400, 1));

    }

}