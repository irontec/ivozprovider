<?php

namespace Ivoz\Api\Entity\Metadata\Property\Factory;

use ApiPlatform\Core\Metadata\Property\Factory\PropertyMetadataFactoryInterface;
use ApiPlatform\Core\Metadata\Property\Factory\PropertyNameCollectionFactoryInterface;
use ApiPlatform\Core\Metadata\Property\PropertyNameCollection;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceNameCollectionFactoryInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;

class PropertyNameCollectionFactory implements PropertyNameCollectionFactoryInterface
{
    /**
     * @var PropertyMetadataFactoryInterface
     */
    protected $propertyMetadataFactory;

    /**
     * @var array
     */
    protected $mappedClasses;
    protected $tokenStorage;
    protected $defaultRole;

    public function __construct(
        PropertyMetadataFactoryInterface $propertyMetadataFactory,
        ResourceNameCollectionFactoryInterface $resourceNameCollectionFactory,
        TokenStorage $tokenStorage,
        string $defaultRole = null
    ) {
        $this->propertyMetadataFactory = $propertyMetadataFactory;
        $this->tokenStorage = $tokenStorage;
        $this->defaultRole = $defaultRole;

        $resourceNameCollection = $resourceNameCollectionFactory->create();
        $this->mappedClasses = [];
        foreach ($resourceNameCollection as $fqdn) {
            $this->mappedClasses[] = $fqdn;
        }
    }

    /**
     * @inheritdoc
     */
    public function create(string $resourceClass, array $options = []): PropertyNameCollection
    {
        $context = $options['context'] ?? '';
        if (array_key_exists('serializer_groups', $options)) {
            $context = $options['serializer_groups'][0];
        }

        $resourceDtoClass = $resourceClass . 'Dto';
        if (class_exists($resourceDtoClass)) {
            $skipRoles = isset($options['skipRoles']) && $options['skipRoles'];
            $role = null;
            if (!$skipRoles) {
                $token = $this->tokenStorage->getToken();
                $roles = $token
                    ? $token->getRoles()
                    : [];
                $role = !empty($roles)
                    ? $roles[0]->getRole()
                    : $this->defaultRole;
            }

            $propertyMap = call_user_func(
                $resourceDtoClass . '::getPropertyMap',
                $context,
                $role
            );
            $attributes = $this->normalizePropertyMap($propertyMap);
            $expandSubResources = isset($options['expandSubResources']) && $options['expandSubResources'];

            foreach ($attributes as $key => $value) {
                if (array_key_exists($value, $propertyMap)) {
                    if (!is_array($propertyMap[$value]) || !$expandSubResources) {
                        continue;
                    }

                    foreach ($propertyMap[$value] as $subAttribute) {
                        $attributes[] = "$value.$subAttribute";
                    }
                    unset($attributes[$key]);
                    continue;
                }

                $propertyMetadata = $this->propertyMetadataFactory->create($resourceClass, $value);
                $targetClass = $propertyMetadata->getType()->getClassName();

                if (!in_array($targetClass, $this->mappedClasses)) {
                    unset($attributes[$key]);
                }
            }
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

    private function normalizePropertyMap(array $propertyMap)
    {
        $response = [];
        foreach ($propertyMap as $key => $value) {
            $response[] = is_array($value)
                ? $key
                : $value;
        }

        return $response;
    }
}
