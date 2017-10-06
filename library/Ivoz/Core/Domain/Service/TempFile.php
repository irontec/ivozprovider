<?php

namespace Ivoz\Core\Domain\Service;

use Ivoz\Core\Application\Service\StoragePathResolverInterace;
use Ivoz\Core\Application\Service\StoragePathResolverInterface;
use Ivoz\Core\Domain\Model\EntityInterface;

class TempFile
{
    /**
     * @var string
     */
    protected $tmpPath;

    /**
     * @var StoragePathResolverInterface
     */
    protected $storagePathResolver;

    public function __construct(string $tmpPath,  StoragePathResolverInterface $storagePathResolver)
    {
        $this->tmpPath = $tmpPath;
        $this->storagePathResolver = $storagePathResolver;
    }

    public function commit(EntityInterface $entity)
    {
        if (!$entity->getId()) {
            Throw new \Exception('Entity must be persisted');
        }

        $targetPath = $this
            ->storagePathResolver
            ->getFilePath(
                $entity->getId()
            );

        $copySucceed = copy(
            $this->tmpPath,
            $targetPath
        );

        if (true === $copySucceed) {
            unlink($this->tmpPath);
        } else {
            throw new \Exception("Could not rename file " . $this->tmpPath . " to " . $copySucceed);
        }
    }

    public function remove(EntityInterface $entity)
    {
        if (!$entity->getId()) {
            Throw new \Exception('Entity must be persisted');
        }

        $filePath = $this
            ->storagePathResolver
            ->getFilePath(
                $entity->getId()
            );

        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}