<?php

namespace Ivoz\Api\Swagger\Metadata\Property;

use ApiPlatform\Core\Api\IdentifiersExtractorInterface;
use ApiPlatform\Core\Metadata\Property\Factory\PropertyNameCollectionFactoryInterface;

class IdentifiersExtractor implements IdentifiersExtractorInterface
{
    protected $decoratedIdentifiersExtractor;

    public function __construct(
        IdentifiersExtractorInterface $decoratedIdentifiersExtractor,
        PropertyNameCollectionFactoryInterface $propertyNameCollectionFactory
    ) {
        $reflection = new \ReflectionClass($decoratedIdentifiersExtractor);
        $property = $reflection->getProperty('propertyNameCollectionFactory');
        $property->setAccessible(true);
        $property->setValue($decoratedIdentifiersExtractor, $propertyNameCollectionFactory);
        $property->setAccessible(false);

        $this->decoratedIdentifiersExtractor = $decoratedIdentifiersExtractor;
    }

    /**
     * @inheritdoc
     */
    public function getIdentifiersFromItem($item): array
    {
        return $this->decoratedIdentifiersExtractor->getIdentifiersFromItem(...func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentifiersFromResourceClass(string $resourceClass): array
    {
        return $this->decoratedIdentifiersExtractor->getIdentifiersFromResourceClass(...func_get_args());
    }
}
