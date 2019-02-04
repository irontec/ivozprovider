<?php

namespace IvozProvider\Utils;

class SizeFormatter
{

    public static function sizeToHuman($total)
    {
        $size = array('B','KB','MB','GB','TB','PB','EB','ZB','YB');
        $factor = 0;

        // Pretty print the size
        while ($total > 1024) {
            $total /= 1024;
            $factor++;
        }

        if ($factor > 2) {
            return sprintf("%.2f%s", $total, $size[$factor]);
        } else {
            return sprintf("%d%s", $total, $size[$factor]);
        }
    }
}
