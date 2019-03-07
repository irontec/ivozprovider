<?php

namespace Ivoz\Core\Infrastructure\Persistence\Doctrine\ORM;

use Doctrine\ORM\EntityManager as DoctrineEntityManager;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\Configuration;
use Doctrine\Common\EventManager;
use Doctrine\ORM\ORMException;

class EntityManager extends DoctrineEntityManager
{
    /**
     * @inheritdoc
     */
    protected function __construct(Connection $conn, Configuration $config, EventManager $eventManager)
    {
        parent::__construct(
            $conn,
            $config,
            $eventManager
        );
    }

    public static function create($conn, Configuration $config, EventManager $eventManager = null)
    {
        if (! $config->getMetadataDriverImpl()) {
            throw ORMException::missingMappingDriverImpl();
        }

        switch (true) {
            case (is_array($conn)):
                $conn = \Doctrine\DBAL\DriverManager::getConnection(
                    $conn,
                    $config,
                    ($eventManager ?: new EventManager())
                );
                break;

            case ($conn instanceof Connection):
                if ($eventManager !== null && $conn->getEventManager() !== $eventManager) {
                    throw ORMException::mismatchedEventManager();
                }
                break;

            default:
                throw new \InvalidArgumentException("Invalid argument: " . $conn);
        }

        return new static($conn, $config, $conn->getEventManager());
    }
}
