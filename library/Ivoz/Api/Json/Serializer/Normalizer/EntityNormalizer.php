<?php

namespace Ivoz\Api\Json\Serializer\Normalizer;

use ApiPlatform\Core\Api\ResourceClassResolverInterface;
use ApiPlatform\Core\JsonLd\ContextBuilderInterface;
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
    const FORMAT = 'json';

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
        ResourceClassResolverInterface $resourceClassResolver,
        ContextBuilderInterface $contextBuilder,
        DtoAssembler $dtoAssembler
    ) {
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
        return static::FORMAT === $format && ($data instanceof EntityInterface);
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
            $object = $this->initializeRelationships($object, []);
        }

        $data = $this->normalizeEntity(
            $object,
            $context
        );

        return $this->flatten($data);
    }

    protected function flatten(array $data = null)
    {
        if (!$data) {
            return $data;
        }

        foreach ($data as $key => $value) {

            if (is_array($value)) {
                $data[$key] = $this->flatten($value);
                continue;
            }

            if (!is_object($value)) {
                continue;
            }

            $class = get_class($value);
            switch ($class) {
                case 'DateTime':
                    /** @todo this should be done by dto::toArray $value */
                    $value = $value->format('Y-m-d H:i:s');
                    break;
            }

            $data[$key] = $value;
        }

        return $data;
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
            ? $resourceMetadata->getItemOperationAttribute($context['item_operation_name'],'depth', 1)
            : $resourceMetadata->getCollectionOperationAttribute($context['collection_operation_name'], 'depth', 1);

        if ($depth > 0) {
            $dtoClass = $resourceClass . 'Dto';
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
    protected function normalizeDto($dto, array $context, $isSubresource, $depth, $resourceClass, $resourceMetadata): array
    {
        $normalizationContext = $context['operation_normalization_context'] ?? $context['operation_type'];
        $rawData = $dto->normalize($normalizationContext);

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
            }
        }

        return $rawData;
    }
}