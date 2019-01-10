<?php

namespace Ivoz\Core\Domain\Service;

use Ivoz\Core\Application\Service\StoragePathResolverInterface;
use Ivoz\Core\Domain\Model\EntityInterface;

class TempFile
{
    /**
     * @var string
     */
    protected $tmpPath;

    /**
     * @var string
     */
    protected $previousFilePath;

    /**
     * @var StoragePathResolverInterface
     */
    protected $storagePathResolver;

    protected $mkdirMode = 0777;

    public function __construct(
        StoragePathResolverInterface $storagePathResolver,
        string $tmpPath = null,
        string $previousFilePath = null
    ) {
        $this->tmpPath = $tmpPath;
        $this->storagePathResolver = $storagePathResolver;
        $this->previousFilePath = $previousFilePath;
    }

    public function getTmpPath()
    {
        return $this->tmpPath;
    }

    public function commit(EntityInterface $entity)
    {
        if (!$entity->getId()) {
            throw new \Exception('Entity must be persisted');
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

        if (!$copySucceed) {
            throw new \Exception('Could not rename file ' . $this->tmpPath . ' to ' . $copySucceed);
        }

        chmod($targetPath, 0777);

        unlink($this->tmpPath);
        if ($this->previousFilePath && ($targetPath != $this->previousFilePath)) {
            unlink($this->previousFilePath);
        }
    }

    public function remove(EntityInterface $entity)
    {
        if ($entity->getId()) {
            throw new \Exception('Entity must be removed first');
        }

        if (file_exists($this->tmpPath)) {
            unlink($this->tmpPath);
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
        $currentDir = '';
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
