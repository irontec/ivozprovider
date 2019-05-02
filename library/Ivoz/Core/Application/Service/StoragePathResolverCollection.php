<?php

namespace Ivoz\Core\Application\Service;

class StoragePathResolverCollection
{
    /**
     * @var StoragePathResolverInterface[]
     */
    protected $pathResolvers = [];

    /**
     * @param string $objName
     * @param StoragePathResolverInterface $storagePathResolver
     *
     * @return void
     */
    public function addPathResolver(string $objName, StoragePathResolverInterface $storagePathResolver)
    {
        $this->pathResolvers[$objName] = $storagePathResolver;
    }

    /**
     * @param string $objName
     * @return StoragePathResolverInterface
     * @throws \Exception
     */
    public function getPathResolver(string $objName)
    {
        if (!array_key_exists($objName, $this->pathResolvers)) {
            throw new \Exception('No path resolver found for ' . $objName, 1000);
        }

        return $this->pathResolvers[$objName];
    }
}
