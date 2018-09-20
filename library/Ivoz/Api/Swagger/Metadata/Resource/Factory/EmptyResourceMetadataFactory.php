<?php

namespace Ivoz\Api\Swagger\Metadata\Resource\Factory;

use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use ApiPlatform\Core\Metadata\Resource\ResourceMetadata;

class EmptyResourceMetadataFactory implements ResourceMetadataFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function create(string $resourceClass): ResourceMetadata
    {
        return new ResourceMetadata();
    }
}
