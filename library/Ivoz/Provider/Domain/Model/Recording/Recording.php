<?php

namespace Ivoz\Provider\Domain\Model\Recording;

/**
 * Recording
 */
class Recording extends RecordingAbstract implements RecordingInterface
{
    use RecordingTrait;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

