<?php

namespace Ivoz\Api\Swagger\Metadata\Property\Factory;

use ApiPlatform\Core\Metadata\Property\Factory\PropertyMetadataFactoryInterface;
use ApiPlatform\Core\Metadata\Property\PropertyMetadata;
use Ivoz\Core\Domain\Model\EntityInterface;

class PropertyMetadataLinkFactory implements PropertyMetadataFactoryInterface
{
    private $decorated;

    public function __construct(PropertyMetadataFactoryInterface $decorated = null)
    {
        $this->decorated = $decorated;
    }

    /**
     * @inheritdoc
     */
    public function create(string $resourceClass, string $property, array $options = []): PropertyMetadata
    {
        $propertyMetadata = $this->decorated->create(...func_get_args());
        $type = $propertyMetadata->getType();

        if (!$type) {
            return $propertyMetadata;
        }

        if (!$typeClass = $type->getClassName()) {
            return $propertyMetadata;
        }

        $isEntity = in_array(EntityInterface::class, class_implements($typeClass));
        $isCollection = $type->isCollection();
        if ($isEntity || $isCollection) {
            $propertyMetadata = $propertyMetadata->withReadable(true);
            $propertyMetadata = $propertyMetadata->withReadableLink(true);
            $propertyMetadata = $propertyMetadata->withWritable(true);
            $propertyMetadata = $propertyMetadata->withWritableLink(false);
        } else {
            $propertyMetadata = $propertyMetadata->withReadableLink(true);
            $propertyMetadata = $propertyMetadata->withReadable(true);
        }

        return $propertyMetadata;
    }
}
