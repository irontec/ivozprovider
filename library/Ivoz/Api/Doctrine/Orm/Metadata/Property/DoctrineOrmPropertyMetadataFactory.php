<?php

declare(strict_types=1);

namespace Ivoz\Api\Doctrine\Orm\Metadata\Property;

use ApiPlatform\Core\Metadata\Property\Factory\PropertyMetadataFactoryInterface;
use ApiPlatform\Core\Metadata\Property\PropertyMetadata;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Symfony\Component\PropertyInfo\Type;

/**
 * Based on ApiPlatform\Core\Bridge\Doctrine\Orm\Metadata\Property\DoctrineOrmPropertyMetadataFactory
 */
final class DoctrineOrmPropertyMetadataFactory implements PropertyMetadataFactoryInterface
{
    private $decorated;
    private $managerRegistry;

    public function __construct(
        ManagerRegistry $managerRegistry
    ) {
        $this->managerRegistry = $managerRegistry;
    }

    /**
     * @param string $resourceClass
     * @param string $property
     * @param array $options
     * @return PropertyMetadata
     */
    public function create(string $resourceClass, string $property, array $options = []): PropertyMetadata
    {
        $manager = $this->managerRegistry->getManagerForClass($resourceClass);
        if (!$manager) {
            return new PropertyMetadata();
        }

        $doctrineClassMetadata = $manager->getClassMetadata($resourceClass);
        if (!$doctrineClassMetadata) {
            return new PropertyMetadata();
        }

        try {
            $field = $doctrineClassMetadata->getAssociationMapping($property);
            return new PropertyMetadata(
                new Type(
                    Type::BUILTIN_TYPE_OBJECT,
                    false,
                    $field['targetEntity']
                )
            );
        } catch (\Exception $e) {
            return new PropertyMetadata(
                new Type(
                    Type::BUILTIN_TYPE_NULL,
                    true,
                    ''
                )
            );
        }
    }
}
