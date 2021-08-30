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
     * @param string $date
     * @param int    $now
     *
     * @return string
     */
    public static function format(string $date, int $now): string
    {

        $compare = $now - strtotime($date);

        if ($compare < 60) {
            return sprintf('%s second', $compare);
        } else if (60 > $minute = ($compare / 60)) {
            return sprintf('%s minute', round($minute));
        } else if (24 > $hour = ($compare / 3600)) {
            return sprintf('%s hour', round($hour));
        }

        return sprintf('%s day', round($compare / 86400));

    }

}