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

    protected $mkdirMode = 0755;

    public function __construct(StoragePathResolverInterface $storagePathResolver, string $tmpPath = null)
    {
        $this->tmpPath = $tmpPath;
        $this->storagePathResolver = $storagePathResolver;
    }

    public function getTmpPath()
    {
        return $this->tmpPath;
    }

    public function commit(EntityInterface $entity)
    {
        if (!$entity->getId()) {
            Throw new \Exception('Entity must be persisted');
        }

        $targetPath = $this
            ->storagePathResolver
            ->getFilePath(
                $entity
            );

        $this->ensureFolder(
            dirname($targetPath)
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
                $entity
            );

        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    private function ensureFolder(string $folder)
    {
        if (file_exists($folder)) {
            return;
        }

        $this->buildDirectoryTree($folder);
    }

    private function buildDirectoryTree(string $targetDir)
    {
        $filePathParts = explode(DIRECTORY_SEPARATOR, $targetDir);
        $currentDir = "";
        foreach ($filePathParts as $dir) {
            $currentDir = $currentDir. DIRECTORY_SEPARATOR. $dir;
            if (!file_exists($currentDir)) {
                if (!@mkdir($currentDir, $this->mkdirMode, true)) {
                    if (!file_exists($currentDir)) {
                        throw new \Exception('Could not create dir ' . $currentDir);
                    }
                } else {
                    chmod($currentDir, $this->mkdirMode);
                }
            }
        }
    }

}