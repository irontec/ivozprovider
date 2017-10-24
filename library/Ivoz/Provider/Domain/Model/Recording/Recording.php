<?php

namespace Ivoz\Provider\Domain\Model\Recording;
use Ivoz\Core\Domain\Model\TempFileContainnerTrait;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
 * Recording
 */
class Recording extends RecordingAbstract implements RecordingInterface, FileContainerInterface
{
    use RecordingTrait;
    use TempFileContainnerTrait;

    /**
     * @return array
     */
    public function getFileObjects()
    {
        return [
            'RecordedFile'
        ];
    }

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

