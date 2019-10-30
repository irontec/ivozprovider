<?php

namespace Ivoz\Core\Infrastructure\Persistence\Doctrine;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Ivoz\Core\Application\Event\CommandWasExecuted;
use Ivoz\Core\Domain\Event\EntityWasUpdated;
use Ivoz\Provider\Domain\Model\Changelog\Changelog;
use Ivoz\Provider\Domain\Model\Commandlog\Commandlog;

abstract class LoggableMigration extends AbstractMigration
{
    private $queries = [];

    public function postUp(Schema $schema)
    {
        $this->logChanges('up');
        parent::postUp(...func_get_args());
    }

    public function postDown(Schema $schema)
    {
        $this->logChanges('down');
        parent::postDown(...func_get_args());
    }

    private function logChanges(string $direction)
    {
        $event = new CommandWasExecuted(
            0,
            get_class($this),
            $direction,
            [],
            []
        );

        $command = Commandlog::fromEvent($event);
        $commandData = $command->toDto()->toArray();
        $commandQuery = $this->createQuery(
            'Commandlog',
            $commandData
        );

        $this->connection->query(
            $commandQuery
        );

        foreach ($this->queries as $query) {
            $event = new EntityWasUpdated(
                'unkown',
                0,
                [
                    'query' => $query,
                    'arguments' => []
                ]
            );

            $changelog = Changelog::fromEvent($event);
            $changelogData = $changelog->toDto()->toArray();
            unset($changelogData['command']);
            $changelogData['commandId'] = $command->getId();

            $changelogQuery = $this->createQuery(
                'Changelog',
                $changelogData
            );

            $this->connection->query(
                $changelogQuery
            );
        }
    }


    /**
     * @param string $entity
     * @param array $commandData
     * @return string
     */
    private function createQuery(string $entity, array $commandData): string
    {
        $fields = array_keys($commandData);
        $values = array_map(
            function ($value) {

                if ($value instanceof \DateTime) {
                    $value = $value->format('Y-m-d H:i:s');
                } elseif (is_array($value)) {
                    $value = json_encode($value);
                }

                return $this->connection->quote($value);
            },
            array_values($commandData)
        );

        $commandQuery =
            'INSERT INTO `'
            . $entity
            .'`(`'
            . implode('`,`', $fields)
            . '`) values ('
            . implode(',', $values)
            . ')';

        return $commandQuery;
    }

    protected function addSql($sql, array $params = [], array $types = [])
    {
        $this->queries[] = $sql;
        parent::addSql(...func_get_args());
    }
}
