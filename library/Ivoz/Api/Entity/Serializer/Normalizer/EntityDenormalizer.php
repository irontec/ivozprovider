<?php

namespace Ivoz\Api\Entity\Serializer\Normalizer;

use ApiPlatform\Core\Exception\InvalidArgumentException;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\DtoAssembler;
use Ivoz\Core\Application\Service\CreateEntityFromDTO;
use Ivoz\Core\Application\Service\UpdateEntityFromDTO;
use Ivoz\Core\Domain\Model\EntityInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use ApiPlatform\Core\Metadata\Property\Factory\PropertyMetadataFactoryInterface;

/**
 * Based on ApiPlatform\Core\JsonLd\Serializer\ItemNormalizer
 */
class EntityDenormalizer implements DenormalizerInterface
{
    private $createEntityFromDTO;
    private $updateEntityFromDTO;
    private $dtoAssembler;
    private $propertyMetadataFactory;
    private $logger;
    private $dateTimeNormalizer;

    /**
     * EntityDenormalizer constructor.
     * @param CreateEntityFromDTO $createEntityFromDTO
     * @param UpdateEntityFromDTO $updateEntityFromDTO
     * @param DtoAssembler $dtoAssembler
     * @param PropertyMetadataFactoryInterface $propertyMetadataFactory
     * @param LoggerInterface $logger
     * @param DateTimeNormalizerInterface $dateTimeNormalizer
     */
    public function __construct(
        CreateEntityFromDTO $createEntityFromDTO,
        UpdateEntityFromDTO $updateEntityFromDTO,
        DtoAssembler $dtoAssembler,
        PropertyMetadataFactoryInterface $propertyMetadataFactory,
        LoggerInterface $logger,
        DateTimeNormalizerInterface $dateTimeNormalizer
    ) {
        $this->createEntityFromDTO = $createEntityFromDTO;
        $this->updateEntityFromDTO = $updateEntityFromDTO;
        $this->dtoAssembler = $dtoAssembler;
        $this->propertyMetadataFactory = $propertyMetadataFactory;
        $this->logger = $logger;
        $this->dateTimeNormalizer = $dateTimeNormalizer;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return class_exists($type . 'Dto');
    }

    /**
     * {@inheritdoc}
     *
     * @throws InvalidArgumentException
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $data = $this->denormalizeDateTimes($data, $class);

        $context['operation_type'] = $context['operation_normalization_context'] ?? DataTransferObjectInterface::CONTEXT_SIMPLE;
        $entity = array_key_exists('object_to_populate', $context)
            ? $context['object_to_populate']
            : null;

        return $this->denormalizeEntity(
            $data,
            $class,
            $entity,
            $context['operation_type']
        );
    }

    /**
     * @param $data
     * @param $class
     */
    protected function denormalizeDateTimes($data, $class)
    {
        $response = [];
        foreach ($data as $fieldName => $value) {
            $response[$fieldName] = $this->dateTimeNormalizer->denormalize(
                $class,
                $fieldName,
                $value
            );
        }

        return $response;
    }

    private function denormalizeEntity(array $input, string $class, EntityInterface $entity = null, string $normalizationContext)
    {
        $target = $entity ? $entity->__toString() : $class;
        $this->logger->info(
            sprintf('Mapping %s into %s', json_encode($input), $target)
        );

        $dtoClass = $class. 'Dto';
        $dto = $entity
            ? $this->dtoAssembler->toDto($entity)
            : new $dtoClass;

        $baseData = $dto->toArray();
        foreach ($baseData as $key => $value) {
            if (!$value instanceof DataTransferObjectInterface) {
                continue;
            }

            unset($baseData[$key]);
            $relKey = $key. 'Id';
            $baseData[$relKey] = $value->getId();
        }
        $data = array_replace_recursive($baseData, $input);
        $dto->denormalize(
            $data,
            $normalizationContext
        );

        return $this->mapToEntity($class, $entity, $dto);
    }

    /**
     * @param string $class
     * @param EntityInterface $entity
     * @param $dto
     * @return EntityInterface
     */
    private function mapToEntity(string $class, EntityInterface $entity = null, DataTransferObjectInterface$dto): EntityInterface
    {
        if ($entity) {
            $this->updateEntityFromDTO->execute(
                $entity,
                $dto
            );

            return $entity;
        }

        return $this->createEntityFromDTO->execute($class, $dto);
    }
}
