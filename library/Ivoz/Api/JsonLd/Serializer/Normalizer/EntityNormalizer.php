<?php

namespace Ivoz\Api\JsonLd\Serializer\Normalizer;

use ApiPlatform\Core\Api\IriConverterInterface;
use ApiPlatform\Core\Api\ResourceClassResolverInterface;
use ApiPlatform\Core\JsonLd\ContextBuilderInterface;
use ApiPlatform\Core\JsonLd\Serializer\JsonLdContextTrait;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
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
        } else if (isset($context['operation_normalization_context']) && $object instanceof EntityInterface) {
            $dtoClass = get_class($object) . 'Dto';
            $propertyMap = $dtoClass::getPropertyMap($context['operation_normalization_context']);
            $this->initializeRelationships($object, array_values($propertyMap));
        }

        $this->iriConverter->getIriFromItem($object);

        return $this->normalizeDto(
            $this->dtoAssembler->toDto($object, 1),
            $format,
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

    private function normalizeDto(DataTransferObjectInterface $dto, string $format, array $context, $isSubresource = false)
    {
        $resourceClass = substr(
            get_class($dto),
            0,
            strlen('Dto') * -1
        );
        $resourceMetadata = $this->resourceMetadataFactory->create($resourceClass);
        $data = $this->addJsonLdContext($this->contextBuilder, $resourceClass, $context);

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

                if ($normalizationContext === DataTransferObjectInterface::CONTEXT_COLLECTION) {
                    $rawData[$key] = $rawData[$key]->getId();
                    continue;
                }

                $embeddedContext = [
                    'item_operation_name' => 'get',
                    'operation_type' => 'item',
                    'request_uri' => $context['request_uri']
                ];

                try {
                    $rawData[$key] = $this->normalizeDto(
                        $value,
                        DataTransferObjectInterface::CONTEXT_COLLECTION,
                        $embeddedContext,
                        true
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