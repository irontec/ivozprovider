<?php

namespace Ivoz\Api\Doctrine\Orm\Extension;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\ContextAwareQueryResultCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use ApiPlatform\Core\Metadata\Resource\ResourceMetadata;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

final class UnpaginatedResultGeneratorExtension implements ContextAwareQueryResultCollectionExtensionInterface
{
    const BATCH_SIZE = 4000;

    private $requestStack;
    private $resourceMetadataFactory;
    private $entityManager;
    private $enabled;
    private $clientEnabled;
    private $enabledParameterName;

    public function __construct(
        RequestStack $requestStack,
        ResourceMetadataFactoryInterface $resourceMetadataFactory,
        EntityManager $entityManager,
        bool $enabled = true,
        bool $clientEnabled = false,
        string $enabledParameterName = 'pagination'
    ) {
        $this->requestStack = $requestStack;
        $this->resourceMetadataFactory = $resourceMetadataFactory;
        $this->entityManager = $entityManager;
        $this->enabled = $enabled;
        $this->clientEnabled = $clientEnabled;
        $this->enabledParameterName = $enabledParameterName;
    }

    /**
     * {@inheritdoc}
     */
    public function applyToCollection(
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass = null,
        string $operationName = null,
        array $context = []
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function supportsResult(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        $request = $this->requestStack->getCurrentRequest();
        if (null === $request) {
            return false;
        }

        $resourceMetadata = $this->resourceMetadataFactory->create($resourceClass);

        $paginationEnabled = $this->isPaginationEnabled(
            $request,
            $resourceMetadata,
            $operationName
        );

        return !($paginationEnabled);
    }

    /**
     * {@inheritdoc}
     */
    public function getResult(
        QueryBuilder $queryBuilder,
        string $resourceClass = null,
        string $operationName = null,
        array $context = []
    ) {
        ini_set('max_execution_time', 0);

        $connection =  $this
            ->entityManager
            ->getConnection();

        $sqlLogger = $connection
            ->getConfiguration()
            ->getSQLLogger();

        $connection
            ->getConfiguration()
            ->setSQLLogger(null);

        (function () {
            $this->connect();
            $driverName = $this->_conn->getAttribute(\PDO::ATTR_DRIVER_NAME);
            if ($driverName === 'mysql') {
                $this->_conn->setAttribute(
                    \PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,
                    false
                );
            }
        })->call($connection);


        $rowCount = 0;
        $query = $queryBuilder->getQuery();
        $iterableResult = $query->iterate();

        while (($entity = $iterableResult->next()) !== false) {
            yield current($entity);

            $rowCount++;
            if (($rowCount % self::BATCH_SIZE) === 0) {
                $this->entityManager->clear();
            }
        }

        $connection
            ->getConfiguration()
            ->setSQLLogger($sqlLogger);
    }

    private function isPaginationEnabled(
        Request $request,
        ResourceMetadata $resourceMetadata,
        string $operationName = null
    ): bool {
        $enabled = $resourceMetadata->getCollectionOperationAttribute($operationName, 'pagination_enabled', $this->enabled, true);
        $clientEnabled = $resourceMetadata->getCollectionOperationAttribute($operationName, 'pagination_client_enabled', $this->clientEnabled, true);

        if ($clientEnabled) {
            $enabled = filter_var(
                $this->getPaginationParameter($request, $this->enabledParameterName, $enabled),
                FILTER_VALIDATE_BOOLEAN
            );
        }

        return $enabled;
    }

    private function getPaginationParameter(
        Request $request,
        string $parameterName,
        $default = null
    ) {
        if (null !== $paginationAttribute = $request->attributes->get('_api_pagination')) {
            return array_key_exists($parameterName, $paginationAttribute) ? $paginationAttribute[$parameterName] : $default;
        }

        return $request->query->get($parameterName, $default);
    }
}
