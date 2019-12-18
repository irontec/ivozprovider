<?php

namespace Ivoz\Api\Doctrine\Orm\Extension;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;
use Ivoz\Api\Core\Security\DataAccessControlHelper;
use Ivoz\Api\Core\Security\DataAccessControlParser;

class SecurityFilterExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{
    /**
     * @var DataAccessControlParser
     */
    protected $dataAccessControlParser;

    public function __construct(
        DataAccessControlParser $dataAccessControlParser
    ) {
        $this->dataAccessControlParser = $dataAccessControlParser;
    }

    /**
     * {@inheritdoc}
     */
    public function applyToItem(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        array $identifiers,
        string $operationName = null,
        array $context = []
    ) {
        $dataAccessControl = $this->dataAccessControlParser->get();

        if (empty($dataAccessControl)) {
            return;
        }

        $queryBuilder->addCriteria(
            DataAccessControlHelper::toCriteria($dataAccessControl)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function applyToCollection(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        string $operationName = null
    ) {
        $dataAccessControl = $this->dataAccessControlParser->get();

        if (empty($dataAccessControl)) {
            return;
        }

        $queryBuilder->addCriteria(
            DataAccessControlHelper::toCriteria($dataAccessControl)
        );
    }
}
