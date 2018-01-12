<?php

namespace Ivoz\Api\Json\Serializer\Normalizer;

use ApiPlatform\Core\Api\ResourceClassResolverInterface;
use ApiPlatform\Core\JsonLd\ContextBuilderInterface;
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
     * @var ContextBuilderInterface
     */
    private $contextBuilder;

    /**
     * @var DtoAssembler
     */
    protected $dtoAssembler;

    public function __construct(
        ResourceClassResolverInterface $resourceClassResolver,
        ContextBuilderInterface $contextBuilder,
        DtoAssembler $dtoAssembler
    ) {
        $this->resourceClassResolver = $resourceClassResolver;
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

        return $this->normalizeDto($this->dtoAssembler->toDto($object, 1), $format, $context);
    }

    private function initializeRelationships(EntityInterface $entity)
    {
        $reflection = new \ReflectionClass($entity);
        $properties = $reflection->getProperties();

        foreach ($properties as $property) {
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

        // Use resolved resource class instead of given resource class to support multiple inheritance child types
        $context['resource_class'] = $resourceClass;

        $rawData = $dto->normalize($context['operation_type']);

        foreach ($rawData as $key => $value) {

            if ($value instanceof DataTransferObjectInterface) {
                if ($isSubresource) {
                    unset($rawData[$key]);
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

        return $rawData;
    }
}