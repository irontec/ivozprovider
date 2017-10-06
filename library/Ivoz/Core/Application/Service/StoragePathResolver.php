<?php

namespace Ivoz\Core\Application\Service;

class StoragePathResolver implements StoragePathResolverInterface
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

    public function __construct(
        string $localStoragePath,
        string $basePath,
        bool $storeInBaseFolder = false
    ) {
        $this->localStoragePath = $this->sanitizePath($localStoragePath);
        $this->basePath = $this->sanitizePath($basePath);
        $this->storeInBaseFolder = $storeInBaseFolder;
    }

    public function getFilePath($id)
    {
        $pathArray = array(
            $this->localStoragePath,
            $this->basePath,
            $this->buildDirectoryTreeById($id),
            $id
        );

        $path = array_filter(
            $pathArray,
            function ($value) {
                return $value !== null;
            },
            ARRAY_FILTER_USE_BOTH
        );

        return implode(DIRECTORY_SEPARATOR, $path);
    }

    protected function buildDirectoryTreeById($id)
    {
        if ($this->storeInBaseFolder) {
            return null;
        }

        if (is_numeric($id)) {

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

        throw new \Exception('Unknown id format');
    }

    protected function sanitizePath($storagePath)
    {
        if (substr($storagePath, -1) === DIRECTORY_SEPARATOR) {
            $storagePath = substr($storagePath,0,-1);
        }

        return $storagePath;
    }
}