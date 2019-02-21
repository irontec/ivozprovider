<?php

namespace Ivoz\Api\Swagger\Metadata\Resource\ResourceMetadata;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use ApiPlatform\Core\Metadata\Resource\ResourceMetadata;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Ivoz\Api\Entity\Metadata\Property\Factory\PropertyNameCollectionFactory;
use Ivoz\Core\Domain\Model\EntityInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;

use Ivoz\Api\Doctrine\Orm\Filter\OrderFilter;
use Ivoz\Api\Doctrine\Orm\Filter\SearchFilter;
use Ivoz\Api\Doctrine\Orm\Filter\DateFilter;
use Ivoz\Api\Doctrine\Orm\Filter\NumericFilter;
use Ivoz\Api\Doctrine\Orm\Filter\BooleanFilter;
use Ivoz\Api\Doctrine\Orm\Filter\RangeFilter;

class FilterMetadataFactory implements ResourceMetadataFactoryInterface
{
    /**
     * @var ResourceMetadataFactoryInterface
     */
    private $decorated;

    /**
     * @var PropertyNameCollectionFactory
     */
    private $propertyNameCollectionFactory;

    /**
     * @var ManagerRegistry
     */
    private $managerRegistry;

    public function __construct(
        ResourceMetadataFactoryInterface $decorated,
        PropertyNameCollectionFactory $propertyNameCollectionFactory,
        ManagerRegistry $managerRegistry
    ) {
        $this->decorated = $decorated;
        $this->propertyNameCollectionFactory = $propertyNameCollectionFactory;
        $this->managerRegistry = $managerRegistry;
    }

    /**
     * @inheritdoc
     */
    public function create(string $resourceClass): ResourceMetadata
    {
        $resourceMetadata = $this->decorated->create($resourceClass);
        $isEntity = in_array(EntityInterface::class, class_implements($resourceClass));
        if (!$isEntity) {
            return $resourceMetadata;
        }

        $attributes = $resourceMetadata->getAttributes();
        $filters = $this->getEntityFilters($resourceClass);
        if (!empty($filters)) {
            $attributes['filters'] = array_keys($filters);
            $attributes['filters'][] = 'ivoz.api.filter.property_filter';
            $attributes['filterFields'] = $filters;
        }
        $resourceMetadata = $resourceMetadata->withAttributes($attributes);

        return $resourceMetadata;
    }

    private function getEntityFilters(string $resourceClass)
    {
        $filters = [
            SearchFilter::SERVICE_NAME => [],
            DateFilter::SERVICE_NAME => [],
            BooleanFilter::SERVICE_NAME => [],
            NumericFilter::SERVICE_NAME => [],
            RangeFilter::SERVICE_NAME => [],
            OrderFilter::SERVICE_NAME => []
        ];

        $attributes = $this->getEntityAttributes($resourceClass);
        foreach ($attributes as $attribute) {
            $type = $this->getFieldType($resourceClass, $attribute);
            if (!is_null($type)) {
                $filters[OrderFilter::SERVICE_NAME][$attribute] = Filter\OrderFilter::NULLS_LARGEST;
            }

            if ($attribute === 'id') {
                continue;
            }

            switch ($type) {
                case 'string':
                case 'guid':
                case 'text':
                    $filters[SearchFilter::SERVICE_NAME][$attribute] = Filter\SearchFilter::STRATEGY_PARTIAL;
                    break;
                case 'smallint':
                case 'integer':
                case 'bigint':
                case 'decimal':
                case 'float':
                    $filters[NumericFilter::SERVICE_NAME][$attribute] = null;
                    $filters[RangeFilter::SERVICE_NAME][$attribute] = null;
                    break;
                case ClassMetadataInfo::MANY_TO_ONE:
                    $filters[SearchFilter::SERVICE_NAME][$attribute] = Filter\SearchFilter::STRATEGY_EXACT;
                    break;
                case 'boolean':
                    $filters[BooleanFilter::SERVICE_NAME][$attribute] = null;
                    break;
                case 'date':
                case 'datetime':
                case 'datetimetz':
                case 'time':
                    $filters[SearchFilter::SERVICE_NAME][$attribute] = Filter\SearchFilter::STRATEGY_START;
                    $filters[DateFilter::SERVICE_NAME][$attribute] = null;
                    break;
                default:
                    // Value object and ClassMetadataInfo::ONE_TO_MANY
            }
        }

        return array_filter($filters, function ($value) {
            return count($value) > 0;
        });
    }

    private function getFieldType(string $resourceClass, string $attribute)
    {
        $metadata = $this->getAttributeMetadata($resourceClass, $attribute);
        if (!$metadata) {
            return null;
        }

        return $metadata['type'];
    }

    private function getAttributeMetadata(string $resourceClass, string $attribute)
    {
        $manager = $this->managerRegistry->getManagerForClass($resourceClass);
        if (!$manager) {
            return null;
        }

        /** @var ClassMetadata $metadata */
        $metadata = $manager->getClassMetadata($resourceClass);

        $items = $metadata->getMetadataValue('fieldMappings');
        $items += array_filter(
            $metadata->getMetadataValue('associationMappings'),
            function ($fld) {
                return $fld['type'] == ClassMetadataInfo::MANY_TO_ONE;
            }
        );

        if (!array_key_exists($attribute, $items)) {
            return null;
        }

        return $items[$attribute];
    }

    private function getEntityAttributes(string $resourceClass)
    {
        return $this->propertyNameCollectionFactory->create(
            $resourceClass,
            ['expandSubResources' => true]
        );
    }
}
