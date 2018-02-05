<?php

namespace Ivoz\Api\JsonLd\Serializer\Normalizer;

use ApiPlatform\Core\Api\IriConverterInterface;
use ApiPlatform\Core\Api\ResourceClassResolverInterface;
use ApiPlatform\Core\JsonLd\ContextBuilderInterface;
use ApiPlatform\Core\JsonLd\Serializer\JsonLdContextTrait;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use Doctrine\ORM\Proxy\Proxy;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\DtoAssembler;
use Ivoz\Core\Domain\Model\EntityInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Based on ApiPlatform\Core\JsonLd\Serializer\ItemNormalizer
 */
class EntityNormalizer implements NormalizerInterface
{
    use JsonLdContextTrait;

    const FORMAT = 'jsonld';

    /**
     * @var IriConverterInterface
     */
    protected $iriConverter;

    /**
     * @var ResourceClassResolverInterface
     */
    protected $resourceClassResolver;

    /**
     * @var ResourceMetadataFactoryInterface
     */
    private $resourceMetadataFactory;

    /**
     * @var ContextBuilderInterface
     */
    private $contextBuilder;

    /**
     * @var DtoAssembler
     */
    private $dtoAssembler;

    public function __construct(
        ResourceMetadataFactoryInterface $resourceMetadataFactory,
        IriConverterInterface $iriConverter,
        ResourceClassResolverInterface $resourceClassResolver,
        ContextBuilderInterface $contextBuilder,
        DtoAssembler $dtoAssembler
    ) {
        $this->iriConverter = $iriConverter;
        $this->resourceClassResolver = $resourceClassResolver;
        $this->resourceMetadataFactory = $resourceMetadataFactory;
        $this->contextBuilder = $contextBuilder;
        $this->dtoAssembler = $dtoAssembler;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return self::FORMAT === $format && ($data instanceof EntityInterface);
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        if (!$object instanceof EntityInterface) {
            Throw new \Exception('Object must implement EntityInterface');
        }

        if (isset($context['item_operation_name']) && $context['item_operation_name'] === 'put') {
            $object = $this->initializeRelationships($object);
        }

        $this->iriConverter->getIriFromItem($object);

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
        $resourceClass = $entity instanceof Proxy
            ? get_parent_class($entity)
            : get_class($entity);

        $resourceMetadata = $this->resourceMetadataFactory->create($resourceClass);

        $depth = isset($context['item_operation_name'])
            ? $resourceMetadata->getItemOperationAttribute($context['item_operation_name'],'depth', 2)
            : $resourceMetadata->getCollectionOperationAttribute($context['collection_operation_name'], 'depth', 1);

        if ($depth > 0) {
            $dtoClass = get_class($entity) . 'Dto';
            $normalizationContext = $context['operation_normalization_context'] ?? $context['operation_type'] ?? '';
            $propertyMap = $dtoClass::getPropertyMap($normalizationContext);
            $this->initializeRelationships($entity, array_values($propertyMap));
        }
        $dto = $this->dtoAssembler->toDto($entity, $depth);

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
     * @param $isSubresource
     * @param $depth
     * @param $resourceClass
     * @param $resourceMetadata
     * @return array
     */
    private function normalizeDto($dto, array $context, $isSubresource, $depth, $resourceClass, $resourceMetadata): array
    {
        $data = $this->addJsonLdContext(
            $this->contextBuilder,
            $resourceClass,
            $context
        );

        // Use resolved resource class instead of given resource class to support multiple inheritance child types
        $context['resource_class'] = $resourceClass;
        $context['iri'] = $this
            ->iriConverter
            ->getItemIriFromResourceClass(
                $resourceClass,
                ['id' => $dto->getId()]
            );

        $normalizationContext = $context['operation_normalization_context'] ?? $context['operation_type'];
        $rawData = $dto->normalize($normalizationContext);

        foreach ($rawData as $key => $value) {

            if ($value instanceof DataTransferObjectInterface) {
                if ($isSubresource) {
                    unset($rawData[$key]);
                    continue;
                }

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
            }
        }

        $data['@id'] = $context['iri'];
        $data['@type'] = $resourceMetadata->getIri() ?: $resourceMetadata->getShortName();

        return $data + $rawData;
    }
}