<?php

namespace Ivoz\Api\Entity\Serializer\Normalizer;

use ApiPlatform\Core\Exception\InvalidArgumentException;
use Doctrine\DBAL\Query\Expression\CompositeExpression;
use Ivoz\Api\Core\Security\DataAccessControlParser;
use Ivoz\Api\Entity\Metadata\Property\Factory\PropertyNameCollectionFactory;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\DtoAssembler;
use Ivoz\Core\Application\Service\CreateEntityFromDTO;
use Ivoz\Core\Application\Service\UpdateEntityFromDTO;
use Ivoz\Core\Domain\Model\EntityInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use ApiPlatform\Core\Metadata\Property\Factory\PropertyMetadataFactoryInterface;
use ApiPlatform\Core\Metadata\Property\PropertyNameCollection;

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
    private $propertyNameCollectionFactory;
    private $dataAccessControlParser;
    protected $tokenStorage;
    private $requestStack;

    public function __construct(
        CreateEntityFromDTO $createEntityFromDTO,
        UpdateEntityFromDTO $updateEntityFromDTO,
        DtoAssembler $dtoAssembler,
        PropertyMetadataFactoryInterface $propertyMetadataFactory,
        LoggerInterface $logger,
        DateTimeNormalizerInterface $dateTimeNormalizer,
        PropertyNameCollectionFactory $propertyNameCollectionFactory,
        DataAccessControlParser $dataAccessControlParser,
        TokenStorage $tokenStorage,
        RequestStack $requestStack
    ) {
        $this->createEntityFromDTO = $createEntityFromDTO;
        $this->updateEntityFromDTO = $updateEntityFromDTO;
        $this->dtoAssembler = $dtoAssembler;
        $this->propertyMetadataFactory = $propertyMetadataFactory;
        $this->logger = $logger;
        $this->dateTimeNormalizer = $dateTimeNormalizer;
        $this->propertyNameCollectionFactory = $propertyNameCollectionFactory;
        $this->dataAccessControlParser = $dataAccessControlParser;
        $this->tokenStorage = $tokenStorage;
        $this->requestStack = $requestStack;
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

        $files = $this->requestStack->getCurrentRequest()->files;
        foreach ($files->all() as $name => $file) {
            $name = lcfirst($name);
            $data[$name] = [
                'fileSize' => $file->getClientSize(),
                'mimeType' => $file->getClientMimeType(),
                'baseName' => $file->getClientOriginalName(),
            ];
            $data[$name . 'Path'] = $file->getPathname();
        }

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
     * @param array $data
     * @param string $class
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
        $propertyNameCollection = $this->propertyNameCollectionFactory->create(
            $class,
            ['context' => $normalizationContext]
        );

        $input = $this->filterInputProperties(
            $input,
            $propertyNameCollection
        );

        $accessControl = $this
            ->dataAccessControlParser
            ->get(DataAccessControlParser::WRITE_ACCESS_CONTROL_ATTRIBUTE);

        foreach ($accessControl as $key => $criteria) {
            $input = $this->injectEqualValuesIfNotPresent(
                $input,
                $criteria
            );
        }

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

            $baseData[$key] = $value->getId();
        }
        $data = array_replace_recursive($baseData, $input);

        $token = $this->tokenStorage->getToken();
        $roles = $token
            ? $token->getRoles()
            : [];
        $role = !empty($roles)
            ? $roles[0]->getRole()
            : null;

        $dto->denormalize(
            $data,
            $normalizationContext,
            $role
        );

        return $this->mapToEntity($class, $entity, $dto);
    }


    /**
     * @param array $input
     * @param mixed $criteria
     */
    private function injectEqualValuesIfNotPresent(array $input, $criteria): array
    {
        if (!is_array($criteria)) {
            return $input;
        }

        foreach ($criteria as $key => $value) {
            if (strtoupper($key) !== CompositeExpression::TYPE_AND) {
                continue;
            }

            foreach ($criteria[$key] as $position => $rule) {
                $input = $this->injectEqualValuesIfNotPresent($input, $rule);
            }
        }

        if (count($criteria) !== 3) {
            return $input;
        }

        list($fld, $operation, $value) = $criteria;

        if (array_key_exists($fld, $input)) {
            return $input;
        }

        if (strtoupper($operation) === 'ISNULL') {
            $input[$fld] = null;
            return $input;
        }

        if (strtoupper($operation) !== 'EQ' || !is_scalar($value)) {
            return $input;
        }

        $input[$fld] = $value;
        return $input;
    }

    /**
     * @param string $class
     * @param EntityInterface $entity
     * @param DataTransferObjectInterface $dto
     * @return EntityInterface
     */
    private function mapToEntity(string $class, EntityInterface $entity = null, DataTransferObjectInterface $dto): EntityInterface
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

    /**
     * @param array $input
     * @param PropertyNameCollection $propertyNameCollection
     * @return array
     */
    private function filterInputProperties(array $input, PropertyNameCollection $propertyNameCollection): array
    {
        $properties = [];
        foreach ($propertyNameCollection as $propertyName) {
            $properties[] = $propertyName;
        }

        $input = array_filter(
            $input,
            function ($fldName) use ($properties) {
                return in_array($fldName, $properties, true);
            },
            ARRAY_FILTER_USE_KEY
        );

        return $input;
    }
}
