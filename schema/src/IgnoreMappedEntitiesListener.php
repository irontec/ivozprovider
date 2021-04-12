<?php

use Doctrine\ORM\Tools\Event\GenerateSchemaEventArgs;

class IgnoreMappedEntitiesListener
{
    private $ignored = [
        'ivozprovider.billablecallhistorics',
    ];

    /**
     * Remove ignored tables /entities from Schema
     *
     * @param GenerateSchemaEventArgs $args
     */
    public function postGenerateSchema(GenerateSchemaEventArgs $args)
    {
        $schema = $args->getSchema();

        foreach ($schema->getTableNames() as $tableName) {
            if (in_array($tableName, $this->ignored)) {
                // remove table from schema
                $schema->dropTable($tableName);
            }
        }
    }
}
