<?php

namespace Ivoz\Provider\Application\Service\MusicOnHold;

use Ivoz\Core\Application\Service\CommonStoragePathResolver;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface;

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
     * @param MusicOnHoldInterface $entity
     * @return null | string
     */
    public function getFilePath(EntityInterface $entity)
    {
        $id = $entity->getId();
        if (!$id) {
            return null;
        }

        if ($this->keepExtension) {
            $id .= '.';
            $id .= pathinfo($this->originalFileName, PATHINFO_EXTENSION);
        }

        $pathArray = [
            $this->localStoragePath,
            $this->basePath,
            $entity->getOwner(),
            $id
        ];

        return $this->pathSegmentsToStr($pathArray);
    }
}
