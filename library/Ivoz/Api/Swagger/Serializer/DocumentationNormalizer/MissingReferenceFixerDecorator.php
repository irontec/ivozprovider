<?php

namespace Ivoz\Api\Swagger\Serializer\DocumentationNormalizer;

use ApiPlatform\Core\Api\ResourceClassResolverInterface;
use ApiPlatform\Core\Documentation\Documentation;
use ApiPlatform\Core\Metadata\Property\Factory\PropertyMetadataFactoryInterface;
use ApiPlatform\Core\Metadata\Property\Factory\PropertyNameCollectionFactoryInterface;
use ApiPlatform\Core\Metadata\Property\PropertyMetadata;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use ApiPlatform\Core\Metadata\Resource\ResourceMetadata;
use Symfony\Component\PropertyInfo\Type;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class MissingReferenceFixerDecorator implements NormalizerInterface
{
    /**
     * @var NormalizerInterface
     */
    protected $decoratedNormalizer;

    /**
     * @var PropertyNameCollectionFactoryInterface
     */
    protected $propertyNameCollectionFactory;

    /**
     * @var ResourceMetadataFactoryInterface
     */
    protected $resourceMetadataFactory;

    /**
     * @var PropertyMetadataFactoryInterface
     */
    protected $propertyMetadataFactory;

    /**
     * @var ResourceClassResolverInterface
     */
    protected $resourceClassResolver;

    public function __construct(
        NormalizerInterface $decoratedNormalizer,
        PropertyNameCollectionFactoryInterface $propertyNameCollectionFactory,
        ResourceMetadataFactoryInterface $resourceMetadataFactory,
        PropertyMetadataFactoryInterface $propertyMetadataFactory,
        ResourceClassResolverInterface $resourceClassResolver
    ) {
        $this->resourceMetadataFactory = $resourceMetadataFactory;
        $this->propertyNameCollectionFactory = $propertyNameCollectionFactory;
        $this->propertyMetadataFactory = $propertyMetadataFactory;
        $this->resourceClassResolver = $resourceClassResolver;

        $reflection = new \ReflectionClass($decoratedNormalizer);
        $property = $reflection->getProperty('propertyNameCollectionFactory');
        $property->setAccessible(true);
        $property->setValue($decoratedNormalizer, $propertyNameCollectionFactory);
        $property->setAccessible(false);

        $this->decoratedNormalizer = $decoratedNormalizer;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $this->decoratedNormalizer->supportsNormalization(...func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $response = $this->decoratedNormalizer->normalize(...func_get_args());
        $response['definitions'] = $this->registerPendingDefinitions(
            $object,
            $response['paths'],
            $response['definitions']
        );

        return $response;
    }

    private function registerPendingDefinitions(Documentation $object, \ArrayObject $paths, \ArrayObject $definitions)
    {
        $pendingDefinitions = $this->getPendingDefinitions($paths, $definitions);

        $resourceNames = [];
        foreach ($object->getResourceNameCollection() as $resourceName) {
            $resourceNames[] = $resourceName;

            $resourceMetadata = $this->resourceMetadataFactory->create($resourceName);

            $resourceShortName = $resourceMetadata->getShortName();
            $normalizationContexts = $resourceMetadata->getAttribute('normalization_context', []);
            $normalizationGroups = $normalizationContexts['groups'] ?? [];

            foreach ($normalizationGroups as $group) {
                $definitionKey = empty($group)
                    ? $resourceShortName
                    : $resourceShortName . '-' . $group;

                if (in_array($definitionKey, $pendingDefinitions, true)) {
                    continue;
                }

                $pendingDefinitions[] = $definitionKey;
            }
        }

        foreach ($pendingDefinitions as $definition) {
            $definitionSegments = explode('-', $definition, 2);
            $resourceClassNames = array_filter($resourceNames, function ($class) use ($definitionSegments) {
                $classSegments = explode('\\', $class);
                $segmentMatch = $definitionSegments[0] === end($classSegments);

                if (!$segmentMatch) {
                    return false;
                }

                $metadata = $this->resourceMetadataFactory->create($class);

                return $metadata->getShortName() === $definitionSegments[0];
            });

            if (empty($resourceClassNames)) {
                continue;
            }

            $resourceClass = current($resourceClassNames);
            $resourceMetadata = $this->resourceMetadataFactory->create($resourceClass);
            $context = end($definitionSegments);

            $definitions[$definition] = $this->getDefinitionSchema(
                $resourceClass,
                $resourceMetadata,
                $definitions,
                ['groups' => [$context]]
            );
        }

        $definitions->ksort();
        return $definitions;
    }

    /**
     * Copied from api platform
     *
     * @see \ApiPlatform\Core\Swagger\Serializer\DocumentationNormalizer
     *
     * @param \ArrayObject     $definitions
     * @param ResourceMetadata $resourceMetadata
     * @param string           $resourceClass
     * @param array|null       $serializerContext
     *
     * @return string
     */
    private function getDefinition(\ArrayObject $definitions, ResourceMetadata $resourceMetadata, string $resourceClass, array $serializerContext = null): string
    {
        $definitionKey = $resourceMetadata->getShortName();
        if (!isset($definitions[$definitionKey])) {
            $definitions[$definitionKey] = [];  // Initialize first to prevent infinite loop
            $definitions[$definitionKey] = $this->getDefinitionSchema($resourceClass, $resourceMetadata, $definitions, $serializerContext);
        }

        return $definitionKey;
    }

    /**
     * Gets a definition Schema Object, copied from api-platform.
     *
     * @see \ApiPlatform\Core\Swagger\Serializer\DocumentationNormalizer
     *
     * @param string           $resourceClass
     * @param ResourceMetadata $resourceMetadata
     * @param \ArrayObject     $definitions
     * @param array|null       $serializerContext
     *
     * @return \ArrayObject
     */
    private function getDefinitionSchema(string $resourceClass, ResourceMetadata $resourceMetadata, \ArrayObject $definitions, array $serializerContext = null): \ArrayObject
    {
        $definitionSchema = new \ArrayObject(['type' => 'object']);

        if (null !== $description = $resourceMetadata->getDescription()) {
            $definitionSchema['description'] = $description;
        }

        if (null !== $iri = $resourceMetadata->getIri()) {
            $definitionSchema['externalDocs'] = ['url' => $iri];
        }

        $options = isset($serializerContext[AbstractNormalizer::GROUPS]) ? ['serializer_groups' => $serializerContext[AbstractNormalizer::GROUPS]] : [];
        foreach ($this->propertyNameCollectionFactory->create($resourceClass, $options) as $propertyName) {
            $propertyMetadata = $this->propertyMetadataFactory->create($resourceClass, $propertyName);
            $normalizedPropertyName = $propertyName;

            if ($propertyMetadata->isRequired()) {
                $definitionSchema['required'][] = $normalizedPropertyName;
            }

            $definitionSchema['properties'][$normalizedPropertyName] = $this->getPropertySchema($propertyMetadata, $definitions, $serializerContext);
        }

        return $definitionSchema;
    }

    /**
     * Gets a property Schema Object, copied from api-platform.
     *
     * @see \ApiPlatform\Core\Swagger\Serializer\DocumentationNormalizer
     *
     * @param PropertyMetadata $propertyMetadata
     * @param \ArrayObject     $definitions
     * @param array|null       $serializerContext
     *
     * @return \ArrayObject
     */
    private function getPropertySchema(PropertyMetadata $propertyMetadata, \ArrayObject $definitions, array $serializerContext = null): \ArrayObject
    {
        $propertySchema = new \ArrayObject($propertyMetadata->getAttributes()['swagger_context'] ?? []);

        if (false === $propertyMetadata->isWritable()) {
            $propertySchema['readOnly'] = true;
        }

        if (null !== $description = $propertyMetadata->getDescription()) {
            $propertySchema['description'] = $description;
        }

        if (null === $type = $propertyMetadata->getType()) {
            return $propertySchema;
        }

        $isCollection = $type->isCollection();
        if (null === $valueType = $isCollection ? $type->getCollectionValueType() : $type) {
            $builtinType = 'string';
            $className = null;
        } else {
            $builtinType = $valueType->getBuiltinType();
            $className = $valueType->getClassName();
        }

        $valueSchema = $this->getType($builtinType, $isCollection, $className, $propertyMetadata->isReadableLink(), $definitions, $serializerContext);

        return new \ArrayObject((array) $propertySchema + $valueSchema);
    }

    /**
     * Gets the Swagger's type corresponding to the given PHP's type, copied from api-platform.
     *
     * @see \ApiPlatform\Core\Swagger\Serializer\DocumentationNormalizer
     *
     * @param string       $type
     * @param bool         $isCollection
     * @param string       $className
     * @param bool         $readableLink
     * @param \ArrayObject $definitions
     * @param array|null   $serializerContext
     *
     * @return array
     */
    private function getType(string $type, bool $isCollection, string $className = null, bool $readableLink = null, \ArrayObject $definitions, array $serializerContext = null): array
    {
        if ($isCollection) {
            return ['type' => 'array', 'items' => $this->getType($type, false, $className, $readableLink, $definitions, $serializerContext)];
        }

        if (Type::BUILTIN_TYPE_STRING === $type) {
            return ['type' => 'string'];
        }

        if (Type::BUILTIN_TYPE_INT === $type) {
            return ['type' => 'integer'];
        }

        if (Type::BUILTIN_TYPE_FLOAT === $type) {
            return ['type' => 'number'];
        }

        if (Type::BUILTIN_TYPE_BOOL === $type) {
            return ['type' => 'boolean'];
        }

        if (Type::BUILTIN_TYPE_OBJECT === $type) {
            if (null === $className) {
                return ['type' => 'string'];
            }

            if (is_subclass_of($className, \DateTimeInterface::class)) {
                return ['type' => 'string', 'format' => 'date-time'];
            }

            if (!$this->resourceClassResolver->isResourceClass($className)) {
                return ['type' => 'string'];
            }

            if (true === $readableLink) {
                return ['$ref' => sprintf(
                    '#/definitions/%s',
                    $this->getDefinition(
                        $definitions,
                        $this->resourceMetadataFactory->create($className),
                        $className,
                        $serializerContext
                    )
                )];
            }
        }

        return ['type' => 'string'];
    }

    /**
     * @param \ArrayObject $paths
     * @param \ArrayObject $definitions
     */
    private function getPendingDefinitions(\ArrayObject $paths, \ArrayObject $definitions)
    {
        $schemas = [];
        foreach ($paths as $path) {
            $schemas = array_merge_recursive(
                $schemas,
                $this->getParameterSchemas($path)
            );
        }

        foreach ($definitions as $definition) {
            foreach ($definition['properties'] as $property) {
                if (!isset($property['$ref'])) {
                    continue;
                }

                $ref = $this->cleanSchema($property['$ref'], true);
                if (in_array($ref, $schemas, true)) {
                    continue;
                }
                $schemas[] = $ref;
            }
        }

        $definitionKeys = array_keys($definitions->getArrayCopy());
        return array_filter($schemas, function ($schema) use ($definitionKeys) {
            return !in_array($schema, $definitionKeys);
        });
    }

    private function getParameterSchemas($path)
    {
        $response = [];
        foreach ($path as $definition) {
            $response = array_merge_recursive(
                $response,
                $this->getPathDefinitionSchemas($definition)
            );
        }

        return $this->cleanSchemaArray($response);
    }

    /**
     * @param array $response
     * @return array
     */
    private function cleanSchemaArray(array $response): array
    {
        return array_map(function ($schema) {
            return $this->cleanSchema($schema);
        }, array_unique($response));
    }

    /**
     * @param string $schema
     * @param bool $removeContext
     * @return string
     */
    private function cleanSchema(string $schema, $removeContext = false): string
    {
        $schemaSegments = explode('/', $schema);
        $schema = end($schemaSegments);

        if ($removeContext) {
            $schemaSegments = explode('-', $schema);
            $schema = $schemaSegments[0];
        }

        return $schema;
    }

    private function getPathDefinitionSchemas(\ArrayObject $definition)
    {
        $schemas = [];
        foreach ($definition['parameters'] as $parameter) {
            if (!isset($parameter['schema']) || !isset($parameter['schema']['$ref'])) {
                continue;
            }

            $schemas[] = $parameter['schema']['$ref'];
        }

        foreach ($definition['responses'] as $response) {
            if (!isset($response['schema']) || !isset($response['schema']['$ref'])) {
                continue;
            }

            $schemas[] = $response['schema']['$ref'];
        }

        return $schemas;
    }
}
