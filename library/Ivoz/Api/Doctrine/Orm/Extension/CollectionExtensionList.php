<?php

namespace Ivoz\Api\Doctrine\Orm\Extension;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;

class CollectionExtensionList
{
    /**
     * @var QueryCollectionExtensionInterface[]
     */
    private $extensions = [];

    public function addExtension(QueryCollectionExtensionInterface $extension)
    {
        $this->extensions[] = $extension;
    }

    /**
     * @return QueryCollectionExtensionInterface[]
     */
    public function get()
    {
        return $this->extensions;
    }

    /**
     * @return \ArrayObject
     */
    public function getArrayObject()
    {
        return new \ArrayObject($this->extensions);
    }
}
