<?php

namespace Ivoz\Provider\Domain\Model\Recording;

use Ivoz\Core\Domain\Model\TempFileContainnerTrait;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
 * Recording
 */
class Recording extends RecordingAbstract implements FileContainerInterface, RecordingInterface
{
    use RecordingTrait;
    use TempFileContainnerTrait;

    /**
     * @return array
     */
    public function getFileObjects(int $filter = null): array
    {
        $fileObjects = [
            'RecordedFile' => [
                FileContainerInterface::DOWNLOADABLE_FILE,
            ]
        ];

        return $this->filterFileObjects(
            $fileObjects,
            $filter
        );
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }
}
