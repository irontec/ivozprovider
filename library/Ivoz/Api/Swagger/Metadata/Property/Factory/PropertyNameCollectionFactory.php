<?php

namespace Ivoz\Api\Swagger\Metadata\Property\Factory;

use ApiPlatform\Core\Metadata\Property\Factory\PropertyNameCollectionFactoryInterface;
use ApiPlatform\Core\Metadata\Property\PropertyNameCollection;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;

class PropertyNameCollectionFactory implements PropertyNameCollectionFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function create(string $resourceClass, array $options = []): PropertyNameCollection
    {
        $context = '';
        if (array_key_exists('serializer_groups', $options)) {
            $context = $options['serializer_groups'][0];
        }

        $resourceDtoClass = $resourceClass . 'Dto';
        if (class_exists($resourceDtoClass)) {
            $propertyMap = call_user_func(
                $resourceDtoClass . '::getPropertyMap',
                $context
            );
            $attributes = array_keys($propertyMap);
        } else {
            $attributes = $this->inspectAttributes($resourceClass);
        }

        return new PropertyNameCollection($attributes);
    }

    private function inspectAttributes($resourceClass)
    {
        if (!class_exists($resourceClass)) {
            throw new \Exception('Unknown class ' . $resourceClass);
        }

        $normalizer = new PropertyNormalizer();
        $reflectionClass = new \ReflectionClass($resourceClass);
        $class = $reflectionClass->newInstanceWithoutConstructor();
        $classState = $normalizer->normalize($class);

        return array_keys($classState);
    }
}