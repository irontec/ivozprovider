<?php

namespace Ivoz\Core\Application\Service;

use Ivoz\Core\Domain\Model\EntityInterface;

interface StoragePathResolverInterface
{
    /**
     * StoragePathResolverInterface constructor.
     * @param string $localStoragePath
     * @param string $basePath
     */
    public function __construct(string $localStoragePath, string $basePath);

    /**
     * @param string|null $originalFileName
     * @return void
     */
    public function setOriginalFileName(string $originalFileName = null);

    /**
     * @param EntityInterface $entity
     * @return string
     */
    public function getFilePath(EntityInterface $entity)/* @todo : ?string */;
}
