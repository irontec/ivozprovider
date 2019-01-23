<?php

namespace Ivoz\Api\Swagger\Metadata\Resource\ResourceMetadata;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use ApiPlatform\Core\Metadata\Resource\ResourceMetadata;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Ivoz\Api\Swagger\Metadata\Property\Factory\PropertyNameCollectionFactory;
use Ivoz\Core\Domain\Model\EntityInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;

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
            'ivoz.api.filter.search' => [],
            'ivoz.api.filter.date' => [],
            'ivoz.api.filter.boolean' => [],
            'ivoz.api.filter.numeric' => [],
            'ivoz.api.filter.range' => [],
            'ivoz.api.filter.order' => []
        ];

        $attributes = $this->getEntityAttributes($resourceClass);
        foreach ($attributes as $attribute) {
            if ($attribute === 'id') {
                continue;
            }

            $type = $this->getFieldType($resourceClass, $attribute);
            switch ($type) {
                case 'string':
                case 'guid':
                    $filters['ivoz.api.filter.search'][$attribute] = Filter\SearchFilter::STRATEGY_START;
                    break;
                case 'text':
                    $filters['ivoz.api.filter.search'][$attribute] = Filter\SearchFilter::STRATEGY_PARTIAL;
                    break;
                case 'smallint':
                case 'integer':
                case 'bigint':
                case 'decimal':
                case 'float':
                    $filters['ivoz.api.filter.numeric'][$attribute] = null;
                    $filters['ivoz.api.filter.range'][$attribute] = null;
                    break;
                case ClassMetadataInfo::MANY_TO_ONE:
                    $filters['ivoz.api.filter.search'][$attribute] = Filter\SearchFilter::STRATEGY_EXACT;
                    break;
                case 'boolean':
                    $filters['ivoz.api.filter.boolean'][$attribute] = null;
                    break;
                case 'date':
                case 'datetime':
                case 'datetimetz':
                case 'time':
                    $filters['ivoz.api.filter.search'][$attribute] = Filter\SearchFilter::STRATEGY_START;
                    $filters['ivoz.api.filter.date'][$attribute] = null;
                    break;
                default:
                    // Value object and ClassMetadataInfo::ONE_TO_MANY
            }

            if (!is_null($type)) {
                $filters['ivoz.api.filter.order'][$attribute] = Filter\OrderFilter::NULLS_LARGEST;
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
