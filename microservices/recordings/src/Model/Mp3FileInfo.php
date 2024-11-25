<?php

namespace Model;

class Mp3FileInfo
{
    protected float|int $lengthEstimate = 0;
    public function __construct(\Zend_Media_Mpeg_Abs $mp3info)
    {
        $this->lengthEstimate  = $mp3info->getLengthEstimate();
    }

    public function getLengthEstimate(): float|int
    {
        return $this->lengthEstimate;
    }
}
