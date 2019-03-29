<?php

namespace Ivoz\Core\Application\Service;

use Ivoz\Core\Domain\Model\EntityInterface;

class CommonStoragePathResolver implements StoragePathResolverInterface
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
    protected $storeInBaseFolder;

    /**
     * @var bool
     */
    protected $keepExtension;

    /**
     * @var string|null
     */
    protected $originalFileName;

    /**
     * CommonStoragePathResolver constructor.
     * @param string $localStoragePath
     * @param string $basePath
     * @param bool $storeInBaseFolder
     * @param bool $keepExtension
     */
    public function __construct(
        string $localStoragePath,
        string $basePath,
        bool $storeInBaseFolder = false,
        bool $keepExtension = false
    ) {
        $this->localStoragePath = $this->sanitizePath($localStoragePath);
        $this->basePath = $this->sanitizePath($basePath);
        $this->storeInBaseFolder = $storeInBaseFolder;
        $this->keepExtension = $keepExtension;
    }

    /**
     * @param string|null $originalFileName
     */
    public function setOriginalFileName(string $originalFileName = null)
    {
        $this->originalFileName = $originalFileName;
    }

    /**
     * @param EntityInterface $entity
     * @return null | string
     */
    public function getFilePath(EntityInterface $entity)
    {
        $id = $entity->getId();
        if (!$id) {
            return null;
        }

        $directoryTree =  $this->buildDirectoryTreeById($id);

        if ($this->keepExtension) {
            $id .= '.';
            $id .= pathinfo($this->originalFileName, PATHINFO_EXTENSION);
        }

        $pathArray = [
            $this->localStoragePath,
            $this->basePath,
            $directoryTree,
            $id
        ];

        return $this->pathSegmentsToStr($pathArray);
    }

    /**
     * @param int $id
     * @return string
     * @throws \Exception
     */
    protected function buildDirectoryTreeById(int $id): string
    {
        if ($this->storeInBaseFolder) {
            return '';
        }

        if (!is_numeric($id)) {
            throw new \Exception('Numeric id was expected');
        }

        $charArray = str_split((string) $id);
        array_pop($charArray);
        if (empty($charArray)) {
            return '0';
        }

        return
            implode(
                DIRECTORY_SEPARATOR,
                $charArray
            );
    }

    /**
     * @param string $storagePath
     * @return string
     */
    protected function sanitizePath(string $storagePath): string
    {
        if (substr($storagePath, -1) === DIRECTORY_SEPARATOR) {
            $storagePath = substr($storagePath, 0, -1);
        }

        return $storagePath;
    }

    /**
     * @param array $pathArray
     * @return string
     */
    protected function pathSegmentsToStr(array $pathArray): string
    {
        /* strip null values */
        $sanitizedPathArray = array_filter(
            $pathArray,
            function ($value) {
                return $value !== null;
            },
            ARRAY_FILTER_USE_BOTH
        );

        return implode(DIRECTORY_SEPARATOR, $sanitizedPathArray);
    }
}
