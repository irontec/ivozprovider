<?php

namespace Ivoz\Provider\Application\Service\MusicOnHold;

use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\CommonStoragePathResolver;

class StoragePathResolver extends CommonStoragePathResolver
{
    /**
     * @var string
     */
    protected $localStoragePath;

    /**
     * @var string
     */
    protected $basePath;

    /**
     * @var bool
     */
    protected $storeInBaseFolder = false;

    /**
     * @var bool
     */
    protected $keepExtension = true;

    /**
     * @var string|null
     */
    protected $originalFileName;

    public function __construct(
        string $localStoragePath,
        string $basePath
    ) {
        $this->localStoragePath = $this->sanitizePath($localStoragePath);
        $this->basePath = $this->sanitizePath($basePath);
    }

    /**
     * @param EntityInterface $entity
     * @return null | string
     */
    public function getFilePath(EntityInterface $entity)/* @todo : ?string */
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
