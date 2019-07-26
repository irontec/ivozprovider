<?php

namespace Ivoz\Core\Infrastructure\Domain\Service;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\Parameter;
use Ivoz\Core\Domain\Event\EntityWasDeleted;
use Ivoz\Core\Domain\Event\EntityWasUpdated;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Infrastructure\Domain\Service\Lifecycle\CommandPersister;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Events as CustomEvents;

class DoctrineQueryRunner
{
    const DEADLOCK_RETRIES = 3;

    protected $em;
    protected $eventPublisher;
    protected $commandPersister;

    public function __construct(
        EntityManagerInterface $em,
        DomainEventPublisher $eventPublisher,
        CommandPersister $commandPersister
    ) {
        $this->em = $em;
        $this->eventPublisher = $eventPublisher;
        $this->commandPersister = $commandPersister;
    }

    public function execute(string $entityName, Query $query)
    {
        /** @var Parameter[] $parameters */
        $parameters = $query->getParameters()->toArray();
        foreach ($parameters as $key => $parameter) {
            $parameters[$key] = [
                $parameter->getName() => $parameter->getValue()
            ];
        }

        $event = new EntityWasUpdated(
            $entityName,
            0,
            [
                'query' => $query->getDql(),
                'arguments' => $parameters
            ]
        );

        $connection = $this->em->getConnection();
        $alreadyWithinTransaction = $connection->isTransactionActive();

        if ($alreadyWithinTransaction) {
            $query->execute();
            $this->eventPublisher->publish($event);

            return;
        }

        $retries = self::DEADLOCK_RETRIES;
        while (0 < $retries--) {
            $this->em->getConnection()->beginTransaction();
            try {
                $query->execute();
                $this->eventPublisher->publish($event);
                $this->commandPersister->persistEvents();

                $this->em->getConnection()->commit();

                break;
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
            }
        }
    }
}
