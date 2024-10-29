<?php

namespace Ivoz\Tests;

use Doctrine\DBAL\Event\ConnectionEventArgs;

class TestSqliteSessionInitListener 
{
    public function postConnect(ConnectionEventArgs $args)
    {
        $disableFk = $_ENV['DISABLE_FK'] ?? false;

        if ($disableFk) {
            return true;
        }

        $connection = $args->getConnection();
        $platform = $connection->getDatabasePlatform()->getName();

        // Check if we're on SQLite
        if ($platform === 'sqlite') {
            $connection->executeStatement('PRAGMA foreign_keys = ON');
        }
    }
}
