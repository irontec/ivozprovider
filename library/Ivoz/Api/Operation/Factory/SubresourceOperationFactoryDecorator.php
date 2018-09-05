<?php

namespace Ivoz\Api\Operation\Factory;

use ApiPlatform\Core\Metadata\Property\Factory\PropertyNameCollectionFactoryInterface;
use ApiPlatform\Core\Operation\Factory\SubresourceOperationFactoryInterface;

class SubresourceOperationFactoryDecorator implements SubresourceOperationFactoryInterface
{
    protected $decoratedNormalizer;

    public function __construct(
        SubresourceOperationFactoryInterface $decoratedNormalizer,
        PropertyNameCollectionFactoryInterface$propertyNameCollectionFactory
    ) {
        $reflection = new \ReflectionClass($decoratedNormalizer);
        $property = $reflection->getProperty('propertyNameCollectionFactory');
        $property->setAccessible(true);
        $property->setValue($decoratedNormalizer, $propertyNameCollectionFactory);
        $property->setAccessible(false);

        $this->decoratedNormalizer = $decoratedNormalizer;
    }

    /**
     * @inheritdoc
     */
    public function create(string $resourceClass): array
    {
        /** @todo we're not using subresources yet */
        return [];
//        return $this->decoratedNormalizer->create(...func_get_args());
    }
}
