<?php

namespace Ivoz\Api\Doctrine\Orm\Filter;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter as BaseOrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @inheritdoc
 */
class OrderFilter extends BaseOrderFilter
{
    const SERVICE_NAME = 'ivoz.api.filter.order';

    use FilterTrait;

    public function __construct(
        ManagerRegistry $managerRegistry,
        $requestStack = null,
        $orderParameterName,
        LoggerInterface $logger = null,
        array $properties = null,
        ResourceMetadataFactoryInterface $resourceMetadataFactory
    ) {
        $this->resourceMetadataFactory = $resourceMetadataFactory;
        parent::__construct($managerRegistry, $requestStack, $orderParameterName, $logger, $properties);
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription(string $resourceClass): array
    {
        $metadata = $this->resourceMetadataFactory->create($resourceClass);
        $this->overrideProperties($metadata->getAttributes());

        $filters = $this->filterDescription(
            parent::getDescription($resourceClass)
        );

        foreach ($filters as $name => $spec) {
            $filters[$name]['swagger']['enum'] = ['ASC', 'DESC'];
        }

        return $filters;
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

        return parent::apply($queryBuilder, $queryNameGenerator, $resourceClass, $operationName, $context);
    }
}
