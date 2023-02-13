<?php

namespace Ivoz\Provider\Domain\Assembler\VoicemailMessage;

use Ivoz\Core\Domain\Service\CommonStoragePathResolver;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\VoicemailMessage\VoicemailMessageInterface;

class StoragePathResolver extends CommonStoragePathResolver
{
    public function __construct(
        string $localStoragePath,
        string $basePath
    ) {
        parent::__construct(
            $localStoragePath,
            $basePath,
            false,
            true
        );
    }

    /**
     * @param VoicemailMessageInterface $entity
     * @return null | string
     */
    public function getFilePath(EntityInterface $entity)
    {
        $id = $entity->getId();
        if (!$id) {
            return null;
        }

        $astVoicemail = $entity->getAstVoicemailMessage();
        if (!$astVoicemail) {
            return null;
        }

        $filename = $astVoicemail->getVoicemailMessageFilePattern();
        $filename .= ".";
        $filename .= pathinfo($this->originalFileName, PATHINFO_EXTENSION);

        $pathArray = [
            $astVoicemail->getDir(),
            $filename,
        ];

        return $this->pathSegmentsToStr($pathArray);
    }
}
