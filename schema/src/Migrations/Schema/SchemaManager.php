<?php

namespace Migrations\Schema;

use Doctrine\DBAL\Schema\MySQLSchemaManager;

class SchemaManager extends MySQLSchemaManager
{
    public function createComparator(): Comparator
    {
        return new Comparator($this->getDatabasePlatform());
    }
}
