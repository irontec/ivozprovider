<?php

namespace Ivoz\Core\Infrastructure\Domain\Service;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\NativeQuery;
use Doctrine\ORM\Query as DqlQuery;
use Doctrine\ORM\Query\Parameter;
use Ivoz\Core\Domain\Event\EntityEventInterface;
use Ivoz\Core\Domain\Event\QueryWasExecuted;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Infrastructure\Domain\Service\Lifecycle\CommandPersister;
use Psr\Log\LoggerInterface;

class DoctrineQueryRunner
{
    const DEADLOCK_RETRIES = 3;

    protected $em;
    protected $eventPublisher;
    protected $commandPersister;
    protected $logger;

    public function __construct(
        EntityManagerInterface $em,
        DomainEventPublisher $eventPublisher,
        CommandPersister $commandPersister,
        LoggerInterface $logger
    ) {
        $this->em = $em;
        $this->eventPublisher = $eventPublisher;
        $this->commandPersister = $commandPersister;
        $this->logger = $logger;
    }

    /**
     * @param string $entityName
     * @param AbstractQuery $query
     * @return int affected rows
     * @throws \Doctrine\DBAL\ConnectionException
     * @throws \Doctrine\DBAL\DBALException
     */
    public function execute(string $entityName, AbstractQuery $query)
    {
        $event = $this->prepareChangelogEvent(
            $entityName,
            $query
        );

        $connection = $this->em->getConnection();
        $alreadyWithinTransaction = $connection->isTransactionActive();

        if ($alreadyWithinTransaction) {
            return $this->runQueryAndReturnAffectedRows(
                $query,
                $event
            );
        }

        $retries = self::DEADLOCK_RETRIES;
        while (0 < $retries--) {
            $this->em->getConnection()->beginTransaction();
            try {
                $affectedRows = $this->runQueryAndReturnAffectedRows(
                    $query,
                    $event
                );
                $this->commandPersister->persistEvents();
                $this->em->getConnection()->commit();

                return $affectedRows;
            } catch (\Exception $e) {

                /**
                 * Excepted issues:
                 * SQLSTATE[40001]: Serialization failure: 1213 Deadlock found when trying to get lock; try restarting transaction
                 * SQLSTATE[HY000]: General error: 1205 Lock wait timeout exceeded; try restarting transaction
                 */
                $this->em->getConnection()->rollBack();
                $lockIssues = false !== strpos(
                    $e->getMessage(),
                    'try restarting transaction'
                );

                if (!$retries || !$lockIssues) {
                    throw $e;
                }

                $this->logger->warning(
                    'Retrying transaction: ' . $e->getMessage()
                );

                sleep(2);
            }
        }
    }

    /**
     * @param AbstractQuery $query
     * @param EntityEventInterface $event
     * @return int $affectedRows
     * @throws \Doctrine\DBAL\DBALException
     */
    private function runQueryAndReturnAffectedRows(AbstractQuery $query, EntityEventInterface $event)
    {
        $isNativeQuery = $query instanceof NativeQuery;
        if ($isNativeQuery) {
            $affectedRows = $this->em->getConnection()->executeUpdate(
                $query->getSQL()
            );
        } else {
            $affectedRows = $query->execute();
        }

        if ($affectedRows > 0) {
            $this->eventPublisher->publish($event);
        }

        return $affectedRows;
    }

    /**
     * @param AbstractQuery $query
     * @return array
     */
    private function getQueryParameters(AbstractQuery $query): array
    {
        /** @var Parameter[] $parameters */
        $parameters = $query->getParameters()->toArray();
        foreach ($parameters as $key => $parameter) {
            $parameters[$key] = [
                $parameter->getName() => $parameter->getValue()
            ];
        }

        return $parameters;
    }

    /**
     * @param string $entityName
     * @param AbstractQuery $query
     * @return QueryWasExecuted
     */
    private function prepareChangelogEvent(string $entityName, AbstractQuery $query): QueryWasExecuted
    {
        $sqlParams = [];
        $types = [];

        /** @var \Closure $dqlParamResolver */
        $dqlParamResolver = function () use (&$sqlParams, &$types) {

            assert(
                $this instanceof DqlQuery,
                new \Exception('dqlParamResolver context must be instance of ' . DqlQuery::class)
            );

            $parser = new \Doctrine\ORM\Query\Parser($this);
            $paramMappings = $parser->parse()->getParameterMappings();
            list($params, $paramTypes) = $this->processParameterMappings($paramMappings);

            $sqlParams = $params;
            $types = $paramTypes;
        };

        if ($query instanceof DqlQuery) {
            $dqlParamResolver->call($query);
        } else {
            $sqlParams = $this->getQueryParameters(
                $query
            );
        }

        return new QueryWasExecuted(
            $entityName,
            0,
            [
                'query' => $query->getSQL(),
                'arguments' => $sqlParams,
                'types' => $types
            ]
        );
    }
}
