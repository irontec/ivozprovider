<?php

namespace Ivoz\Api\Doctrine\Orm\Filter;

use ApiPlatform\Core\Api\IriConverterInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter as BaseSearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use ApiPlatform\Core\Metadata\Resource\ResourceMetadata;
use Doctrine\ORM\QueryBuilder;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 * @inheritdoc
 */
class SearchFilter extends BaseSearchFilter
{
    const SERVICE_NAME = 'ivoz.api.filter.search';

    use FilterTrait;

    protected $requestStack;

    public function __construct(
        ManagerRegistry $managerRegistry,
        $requestStack = null,
        IriConverterInterface $iriConverter,
        PropertyAccessorInterface $propertyAccessor = null,
        LoggerInterface $logger = null,
        array $properties = null,
        ResourceMetadataFactoryInterface $resourceMetadataFactory
    ) {
        $this->resourceMetadataFactory = $resourceMetadataFactory;
        $this->requestStack = $requestStack;
        parent::__construct(
            $managerRegistry,
            $requestStack,
            $iriConverter,
            $propertyAccessor,
            $logger,
            $properties
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription(string $resourceClass): array
    {
        $metadata = $this->resourceMetadataFactory->create($resourceClass);
        $this->overrideProperties($metadata->getAttributes());

        return $this->filterDescription(
            parent::getDescription($resourceClass)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function apply(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        string $operationName = null,
        array $context = []
    ) {
        $metadata = $this->resourceMetadataFactory->create($resourceClass);
        $this->overrideProperties($metadata->getAttributes());

        $context['filters'] = $this->dateFiltersToUtc(
            $metadata,
            $context['filters']
        );

        return parent::apply($queryBuilder, $queryNameGenerator, $resourceClass, $operationName, $context);
    }

    protected function dateFiltersToUtc(ResourceMetadata $metadata, array $filters)
    {
        foreach ($filters as $field => $criteria) {
            if (!$this->isDateTime($metadata, $field)) {
                continue;
            }

            if (!is_scalar($criteria)) {
                continue;
            }

            $filters[$field] = $this->stringToUtc($criteria);
        }

        return $filters;
    }

    protected function stringToUtc($value)
    {
        $format = strlen(trim($value)) < strlen('Y-m-d H:i:s')
            ? 'Y-m-d'
            : 'Y-m-d H:i:s';

        return DateTimeHelper::stringToUtc(
            $value,
            $format,
            $this->getTimezone()
        );
    }

    /**
     * @param ResourceMetadata $metadata
     * @param string $field
     * @return bool|void
     */
    private function isDateTime(ResourceMetadata $metadata, string $field)
    {
        $filterFields = $metadata->getAttribute(
            'filterFields'
        );

        if (!array_key_exists(DateFilter::SERVICE_NAME, $filterFields)) {
            return;
        }
        $dateFilterFields = $filterFields[DateFilter::SERVICE_NAME];

        return array_key_exists(
            $field,
            $dateFilterFields
        );
    }

    /**
     * @return \DateTimeZone
     */
    private function getTimezone()
    {
        $request = $this->requestStack->getCurrentRequest();

        $timezone = $request->query->get('_timezone', null);
        if (!$timezone) {
            return new \DateTimeZone('UTC');
        }

        return new \DateTimeZone($timezone);
    }
}
