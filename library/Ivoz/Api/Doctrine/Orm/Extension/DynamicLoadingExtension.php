<?php

namespace Ivoz\Api\Doctrine\Orm\Extension;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\EagerLoadingTrait;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Core\Exception\PropertyNotFoundException;
use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use ApiPlatform\Core\Exception\RuntimeException;
use ApiPlatform\Core\Metadata\Property\Factory\PropertyMetadataFactoryInterface;
use ApiPlatform\Core\Metadata\Property\Factory\PropertyNameCollectionFactoryInterface;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use ApiPlatform\Core\Serializer\SerializerContextBuilderInterface;
use Doctrine\ORM\QueryBuilder;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactoryInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;

/**
 * Class DynamicLoadingExtension
 * Based on ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\EagerLoadingExtension
 */
final class DynamicLoadingExtension implements QueryItemExtensionInterface, QueryCollectionExtensionInterface
{
    use EagerLoadingTrait;

    private $propertyNameCollectionFactory;
    private $propertyMetadataFactory;
    private $classMetadataFactory;
    private $serializerContextBuilder;
    private $requestStack;

    public function __construct(
        PropertyNameCollectionFactoryInterface $propertyNameCollectionFactory,
        PropertyMetadataFactoryInterface $propertyMetadataFactory,
        ResourceMetadataFactoryInterface $resourceMetadataFactory,
        RequestStack $requestStack = null,
        SerializerContextBuilderInterface $serializerContextBuilder = null,
        ClassMetadataFactoryInterface $classMetadataFactory = null
    ) {
        $this->propertyNameCollectionFactory = $propertyNameCollectionFactory;
        $this->propertyMetadataFactory = $propertyMetadataFactory;
        $this->resourceMetadataFactory = $resourceMetadataFactory;
        $this->classMetadataFactory = $classMetadataFactory;
        $this->serializerContextBuilder = $serializerContextBuilder;
        $this->requestStack = $requestStack;
    }

    /**
     * {@inheritdoc}
     */
    public function applyToItem(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        array $identifiers,
        string $operationName = null,
        array $context = []
    ) {
        $options = [];

        if (null !== $operationName) {
            $options = ['item_operation_name' => $operationName];
        }

        $contextType = isset($context['api_denormalize']) ? 'denormalization_context' : 'normalization_context';
        $serializerContext = $this->getSerializerContext(
            $context['resource_class'] ?? $resourceClass,
            $contextType,
            $options
        );

        $this->apply($queryBuilder, $queryNameGenerator, $resourceClass, $context, $options, $serializerContext);
    }

    /**
     * {@inheritdoc}
     */
    public function applyToCollection(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        string $operationName = null
    ) {
        $options = [];

        if (null !== $operationName) {
            $options = ['collection_operation_name' => $operationName];
        }

        $contextType = 'normalization_context';
        $serializerContext = $this->getSerializerContext($resourceClass, $contextType, $options);

        $this->apply($queryBuilder, $queryNameGenerator, $resourceClass, [], $options, $serializerContext);
    }


    /**
     * @param QueryBuilder $queryBuilder
     * @param QueryNameGeneratorInterface $queryNameGenerator
     * @param string $resourceClass
     * @param array $context
     * @param array $options
     * @param array $serializerContext
     */
    private function apply(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        array $context,
        $options,
        $serializerContext
    ) {
        if (isset($context[AbstractNormalizer::GROUPS])) {
            $groups = ['serializer_groups' => $context[AbstractNormalizer::GROUPS]];
        } else {
            $groups = $this->getSerializerGroups($options, $serializerContext);
        }

        $this->joinRelations(
            $queryBuilder,
            $queryNameGenerator,
            $resourceClass,
            $queryBuilder->getRootAliases()[0],
            $groups,
            $serializerContext
        );
    }

    /**
     * Joins relations to eager load.
     *
     * @param QueryBuilder $queryBuilder
     * @param QueryNameGeneratorInterface $queryNameGenerator
     * @param string $resourceClass
     * @param string $parentAlias
     * @param array $propertyMetadataOptions
     * @param array $context
     * @param bool $wasLeftJoin if the relation containing the new one had a left join, we have to force the new one to left join too
     * @param int $joinCount the number of joins
     * @param int $currentDepth the current max depth
     *
     * @throws RuntimeException when the max number of joins has been reached
     */
    private function joinRelations(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        string $parentAlias,
        array $propertyMetadataOptions = [],
        array $context = [],
        bool $wasLeftJoin = false,
        int &$joinCount = 0,
        int $currentDepth = null
    ) {
        $currentDepth = $currentDepth > 0 ? $currentDepth - 1 : $currentDepth;
        $entityManager = $queryBuilder->getEntityManager();
        $classMetadata = $entityManager->getClassMetadata($resourceClass);
        $targetProperties = $this->getTargetPropertiesByContext($resourceClass, $context);

        foreach ($classMetadata->associationMappings as $association => $mapping) {
            if (!in_array($association, $targetProperties)) {
                continue;
            }

            //Don't join if max depth is enabled and the current depth limit is reached
            if (isset($context[AbstractObjectNormalizer::ENABLE_MAX_DEPTH]) && 0 === $currentDepth) {
                continue;
            }

            try {
                $propertyMetadata = $this->propertyMetadataFactory->create(
                    $resourceClass,
                    $association,
                    $propertyMetadataOptions
                );
            } catch (PropertyNotFoundException $propertyNotFoundException) {
                //skip properties not found
                continue;
            } catch (ResourceClassNotFoundException $resourceClassNotFoundException) {
                //skip associations that are not resource classes
                continue;
            }

            if ((false === $propertyMetadata->isReadableLink() || false === $propertyMetadata->isReadable())
                && false === $propertyMetadata->getAttribute('fetchEager', false)
            ) {
                continue;
            }

            $isNullable = $mapping['joinColumns'][0]['nullable'] ?? true;
            if (false !== $wasLeftJoin || true === $isNullable) {
                $method = 'leftJoin';
            } else {
                $method = 'innerJoin';
            }

            $associationAlias = $queryNameGenerator->generateJoinAlias($association);
            $queryBuilder->{$method}(sprintf('%s.%s', $parentAlias, $association), $associationAlias);
            ++$joinCount;

            try {
                $this->addSelect($queryBuilder, $mapping['targetEntity'], $associationAlias, $propertyMetadataOptions);
            } catch (ResourceClassNotFoundException $resourceClassNotFoundException) {
                continue;
            }

            // Avoid recursion
            if ($mapping['targetEntity'] === $resourceClass) {
                $queryBuilder->addSelect($associationAlias);
                continue;
            }
        }
    }

    private function addSelect(
        QueryBuilder $queryBuilder,
        string $entity,
        string $associationAlias,
        array $propertyMetadataOptions
    ) {
        $select = [];
        $entityManager = $queryBuilder->getEntityManager();
        $targetClassMetadata = $entityManager->getClassMetadata($entity);
        if ($targetClassMetadata->subClasses) {
            $queryBuilder->addSelect($associationAlias);
        } else {
            $options = [
                'serializer_groups' => [
                    DataTransferObjectInterface::CONTEXT_SIMPLE
                ],
                'skipRoles' => true
            ];
            foreach ($this->propertyNameCollectionFactory->create($entity, $options) as $property) {
                $propertyMetadata = $this->propertyMetadataFactory->create(
                    $entity,
                    $property,
                    $propertyMetadataOptions
                );

                if (true === $propertyMetadata->isIdentifier()) {
                    $select[] = $property;
                    continue;
                }

                if ($targetClassMetadata->hasField($property)) {
                    $select[] = $property;
                }

                if (array_key_exists($property, $targetClassMetadata->embeddedClasses)) {
                    $embeddedProperties = $this->propertyNameCollectionFactory->create(
                        $targetClassMetadata->embeddedClasses[$property]['class']
                    );

                    foreach ($embeddedProperties as $embeddedProperty) {
                        $propertyMetadata = $this->propertyMetadataFactory->create(
                            $entity,
                            $property,
                            $propertyMetadataOptions
                        );
                        $propertyName = "$property.$embeddedProperty";
                        if ($targetClassMetadata->hasField($propertyName) && (true === $propertyMetadata->getAttribute('fetchable') || $propertyMetadata->isReadable())) {
                            $select[] = $propertyName;
                        }
                    }
                }
            }

            $queryBuilder->addSelect(sprintf('partial %s.{%s}', $associationAlias, implode(',', $select)));
        }
    }

    /**
     * Gets serializer context.
     *
     * @param string $resourceClass
     * @param string $contextType normalization_context or denormalization_context
     * @param array $options represents the operation name so that groups are the one of the specific operation
     *
     * @return array
     */
    private function getSerializerContext(string $resourceClass, string $contextType, array $options): array
    {
        $request = null;

        if (null !== $this->requestStack && null !== $this->serializerContextBuilder) {
            $request = $this->requestStack->getCurrentRequest();
        }

        if (null !== $this->serializerContextBuilder && null !== $request) {
            return $this->serializerContextBuilder->createFromRequest(
                $request,
                'normalization_context' === $contextType
            );
        }

        $resourceMetadata = $this->resourceMetadataFactory->create($resourceClass);

        if (isset($options['collection_operation_name'])) {
            $context = $resourceMetadata->getCollectionOperationAttribute(
                $options['collection_operation_name'],
                $contextType,
                null,
                true
            );
        } elseif (isset($options['item_operation_name'])) {
            $context = $resourceMetadata->getItemOperationAttribute(
                $options['item_operation_name'],
                $contextType,
                null,
                true
            );
        } else {
            $context = $resourceMetadata->getAttribute($contextType);
        }

        return $context ? $context : [];
    }

    /**
     * Gets serializer groups if available, if not it returns the $options array.
     *
     * @param array $options represents the operation name so that groups are the one of the specific operation
     * @param array $context
     *
     * @return array
     */
    private function getSerializerGroups(array $options, array $context): array
    {
        if (empty($context[AbstractNormalizer::GROUPS])) {
            return $options;
        }

        return ['serializer_groups' => $context[AbstractNormalizer::GROUPS]];
    }

    /**
     * @param string $resourceClass
     * @param array $context
     * @return array
     * @throws ResourceClassNotFoundException
     */
    private function getTargetPropertiesByContext(string $resourceClass, array $context)
    {

        if (!isset($context['groups'])) {
            return [];
        }

        $contextGroup = $context['groups'][0];

        $targetPropertyOptions = [
            'serializer_groups' => [$contextGroup],
        ];
        $targetProperties = $this
            ->propertyNameCollectionFactory
            ->create($resourceClass, $targetPropertyOptions);

        $response = [];
        foreach ($targetProperties as $item) {
            $response[] = $item;
        }

        $attributeFilter = $context['attributes'] ?? [];
        if (empty($attributeFilter)) {
            return $response;
        }

        return array_intersect($response, $attributeFilter);
    }
}
