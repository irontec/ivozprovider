<?php

namespace Ivoz\Api\Swagger\Metadata\Property\Factory;

use ApiPlatform\Core\Metadata\Property\Factory\PropertyMetadataFactoryInterface;
use ApiPlatform\Core\Metadata\Property\PropertyMetadata;
use Doctrine\Common\Annotations\Reader;
use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Core\Domain\Model\EntityInterface;
use Symfony\Component\PropertyInfo\Type;

/**
 * Class PropertyMetadataOverwriteFactory
 * @package Ivoz\Api\Swagger\Metadata\Property\Factory
 */
class PropertyMetadataOverwriteFactory implements PropertyMetadataFactoryInterface
{
    private $decorated;

    /**
     * @var Reader
     */
    private $reader;

    /**
     * PropertyMetadataOverwriteFactory constructor.
     * @param PropertyMetadataFactoryInterface|null $decorated
     * @param Reader $reader
     */
    public function __construct(
        PropertyMetadataFactoryInterface $decorated = null,
        Reader $reader
    ) {
        $this->decorated = $decorated;
        $this->reader = $reader;
    }

    /**
     * @inheritdoc
     */
    public function create(string $resourceClass, string $property, array $options = []): PropertyMetadata
    {
        /** @var PropertyMetadata $propertyMetadata */
        $propertyMetadata = $this->decorated->create(...func_get_args());
        $attributes = $propertyMetadata->getAttribute('swagger_context', []);
        $propertyMetadata = $propertyMetadata->withDescription(
            $attributes['description'] ?? ''
        );

        $reflectionProperty = $this->getReflectionProperty($resourceClass, $property);
        if (!$reflectionProperty) {
            return $propertyMetadata;
        }

        /** @var AttributeDefinition $annotation */
        $annotation = $this->reader->getPropertyAnnotation(
            $reflectionProperty,
            AttributeDefinition::class
        );

        if (!$annotation) {
            return $propertyMetadata;
        }

        $isCollection = $annotation->type === Type::BUILTIN_TYPE_ARRAY;

        $collectionValueType = $isCollection && $annotation->class
            ? new Type(Type::BUILTIN_TYPE_OBJECT, true, $annotation->class)
            : null;

        if (!$collectionValueType && $annotation->collectionValueType) {
            $collectionValueType = new Type(
                $annotation->collectionValueType
            );
        }

        $type = new Type(
            $annotation->type,
            !$annotation->required,
            $annotation->class,
            $isCollection,
            null,
            $collectionValueType
        );

        $propertyMetadata = $propertyMetadata->withType($type);
        $propertyMetadata = $propertyMetadata->withDescription($annotation->description);
        $propertyMetadata = $propertyMetadata->withRequired($annotation->required);

        return $propertyMetadata->withWritable($annotation->writable);
    }

    private function getReflectionProperty(string $resourceClass, string $property)
    {
        $reflectionClass = new \ReflectionClass($resourceClass);
        if ($reflectionClass->newInstanceWithoutConstructor() instanceof EntityInterface) {
            $dto = $resourceClass::createDto();
            $reflectionClass = new \ReflectionClass($dto);
        }

        return $reflectionClass->hasProperty($property)
            ? $reflectionClass->getProperty($property)
            : null;
    }
}
