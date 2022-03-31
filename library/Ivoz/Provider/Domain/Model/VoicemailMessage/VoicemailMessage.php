<?php

namespace Ivoz\Provider\Domain\Model\VoicemailMessage;

use Ivoz\Core\Domain\Model\TempFileContainnerTrait;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
 * VoicemailMessage
 */
class VoicemailMessage extends VoicemailMessageAbstract implements FileContainerInterface, VoicemailMessageInterface
{
    use VoicemailMessageTrait;
    use TempFileContainnerTrait;

    /**
     * @codeCoverageIgnore
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getFileObjects(int $filter = null): array
    {
        $fileObjects = [
            'RecordingFile' => [
                FileContainerInterface::DOWNLOADABLE_FILE,
            ],
            'MetadataFile' => [
                FileContainerInterface::DOWNLOADABLE_FILE,
            ]
        ];

        return $this->filterFileObjects(
            $fileObjects,
            $filter
        );
    }
}
