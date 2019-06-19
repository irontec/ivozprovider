<?php

namespace Ivoz\Api\Json\Serializer\Normalizer;

use ApiPlatform\Core\Api\ResourceClassResolverInterface;
use ApiPlatform\Core\JsonLd\ContextBuilderInterface;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use ApiPlatform\Core\Metadata\Resource\ResourceMetadata;
use Ivoz\Api\Entity\Serializer\Normalizer\DateTimeNormalizerInterface;
use Ivoz\Api\Entity\Metadata\Property\Factory\PropertyNameCollectionFactory;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\DtoAssembler;
use Ivoz\Core\Domain\Model\EntityInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Based on ApiPlatform\Core\JsonLd\Serializer\ItemNormalizer
 */
class EntityNormalizer implements NormalizerInterface
{
    const FORMAT = 'json';

    protected $resourceClassResolver;
    private $resourceMetadataFactory;
    private $contextBuilder;
    private $dtoAssembler;
    private $dateTimeNormalizer;
    protected $propertyNameCollectionFactory;
    protected $tokenStorage;

    public function __construct(
        ResourceMetadataFactoryInterface $resourceMetadataFactory,
        ResourceClassResolverInterface $resourceClassResolver,
        ContextBuilderInterface $contextBuilder,
        DtoAssembler $dtoAssembler,
        DateTimeNormalizerInterface $dateTimeNormalizer,
        PropertyNameCollectionFactory $propertyNameCollectionFactory,
        TokenStorage $tokenStorage
    ) {
        $this->resourceClassResolver = $resourceClassResolver;
        $this->resourceMetadataFactory = $resourceMetadataFactory;
        $this->contextBuilder = $contextBuilder;
        $this->dtoAssembler = $dtoAssembler;
        $this->dateTimeNormalizer = $dateTimeNormalizer;
        $this->propertyNameCollectionFactory = $propertyNameCollectionFactory;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return static::FORMAT === $format && ($data instanceof EntityInterface);
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        if (!$object instanceof EntityInterface) {
            throw new \Exception('Object must implement EntityInterface');
        }

        if (isset($context['item_operation_name']) && $context['item_operation_name'] === 'put') {
            $object = $this->initializeRelationships($object, []);
        }

        return $this->normalizeEntity(
            $object,
            $context
        );
    }

    private function initializeRelationships(EntityInterface $entity, array $propertyFilters)
    {
        $reflection = new \ReflectionClass($entity);
        $properties = $reflection->getProperties();

        foreach ($properties as $property) {
            if (!empty($propertyFilters) && !in_array($property->getName(), $propertyFilters)) {
                continue;
            }

            $property->setAccessible(true);
            $propertyValue = $property->getValue($entity);
            if ($propertyValue instanceof \Doctrine\ORM\Proxy\Proxy && !$propertyValue->__isInitialized()) {
                $propertyValue->__load();
            }
        }

        return $entity;
    }

    private function normalizeEntity(
        Entityinterface $entity,
        array $context,
        $isSubresource = false
    ) {
        $resourceClass = $entity instanceof \Doctrine\ORM\Proxy\Proxy
            ? get_parent_class($entity)
            : get_class($entity);

        $resourceMetadata = $this->resourceMetadataFactory->create($resourceClass);

        $depth = isset($context['item_operation_name'])
            ? $resourceMetadata->getItemOperationAttribute($context['item_operation_name'], 'depth', 1)
            : $resourceMetadata->getCollectionOperationAttribute($context['collection_operation_name'], 'depth', 0);

        if ($depth > 0) {
            $dtoClass = $resourceClass . 'Dto';
            $normalizationContext = $context['operation_normalization_context'] ?? $context['operation_type'] ?? '';
            $propertyMap = $dtoClass::getPropertyMap($normalizationContext);
            $this->initializeRelationships($entity, array_values($propertyMap));
        }
        $dto = $this->dtoAssembler->toDto(
            $entity,
            $depth,
            $context['operation_normalization_context'] ?? null
        );

        return $this->normalizeDto(
            $dto,
            $context,
            $isSubresource,
            $depth,
            $resourceClass,
            $resourceMetadata
        );
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @param array $context
     * @param bool $isSubresource
     * @param int $depth
     * @param string $resourceClass
     * @param ResourceMetadata $resourceMetadata
     * @return array
     */
    protected function normalizeDto(
        $dto,
        array $context,
        $isSubresource,
        $depth,
        $resourceClass,
        $resourceMetadata
    ): array {
        $normalizationContext = $context['operation_normalization_context'] ?? null;
        if (!$normalizationContext) {
            $isPostOperation =
                isset($context['collection_operation_name'])
                && $context['collection_operation_name'] === 'post';

            $normalizationContext = $isPostOperation
                ? ''
                : $context['operation_type'];
        }
        $forcedAttributes = $context['attributes'] ?? [];

        $token = $this->tokenStorage->getToken();
        $roles = $token
            ? $token->getRoles()
            : [];
        $role = !empty($roles)
            ? $roles[0]->getRole()
            : null;

        $rawData = $this->filterProperties(
            $dto->normalize($normalizationContext, $role),
            $resourceClass,
            $forcedAttributes,
            ['serializer_groups' => [$normalizationContext]]
        );

        foreach ($rawData as $key => $value) {
            if ($value instanceof DataTransferObjectInterface) {
                if ($depth == 0) {
                    $rawData[$key] = $rawData[$key]->getId();
                    continue;
                }

                $embeddedContext = [
                    'item_operation_name' => 'get',
                    'operation_type' => 'item',
                    'request_uri' => $context['request_uri']
                ];

                try {
                    $resourceClass = substr(get_class($value), 0, strlen('dto') * -1);
                    $resourceMetadata = $this
                        ->resourceMetadataFactory
                        ->create($resourceClass);

                    $rawData[$key] = $this->normalizeDto(
                        $value,
                        $embeddedContext,
                        true,
                        $depth - 1,
                        $resourceClass,
                        $resourceMetadata
                    );
                } catch (\Exception $e) {
                    unset($rawData[$key]);
                }
            } elseif ($value instanceof \DateTimeInterface) {
                $rawData[$key] = $this->dateTimeNormalizer->normalize(
                    $resourceClass,
                    $key,
                    $value
                );
            }
        }

        return $rawData;
    }

    private function filterProperties(array $data, string $resourceClass, $requestedAttributes, $options)
    {
        $mappedProperties = [];
        $propertyNameCollection = $this->propertyNameCollectionFactory->create(
            $resourceClass,
            $options
        );
        foreach ($propertyNameCollection as $property) {
            $mappedProperties[] = $property;
        }

        if (!empty($requestedAttributes)) {
            $mappedProperties = array_intersect($mappedProperties, $requestedAttributes);
        }

        $response = array_filter(
            $data,
            function ($property) use ($mappedProperties) {
                return in_array($property, $mappedProperties);
            },
            ARRAY_FILTER_USE_KEY
        );

        return $response;
    }
}
