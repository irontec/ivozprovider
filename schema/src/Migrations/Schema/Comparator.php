<?php

namespace Migrations\Schema;

use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Platforms\AbstractMySQLPlatform;
use Doctrine\DBAL\Platforms\MySQL\Comparator as MySQLComparator;
use Doctrine\DBAL\Schema\ColumnDiff;
use Doctrine\DBAL\Schema\Index;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Schema\TableDiff;

/**
 * Compares schemas in the context of MySQL platform.
 *
 * In MySQL, unless specified explicitly, the column's character set and collation are inherited from its containing
 * table. So during comparison, an omitted value and the value that matches the default value of table in the
 * desired schema must be considered equal.
 */
class Comparator extends MySQLComparator
{
    /**
     * @internal The comparator can be only instantiated by a schema manager.
     */
    public function __construct(
        private AbstractMySQLPlatform $platform
    ) {
        parent::__construct($platform);
    }

    /**
     * Returns the difference between the tables $fromTable and $toTable.
     *
     * If there are no differences this method returns the boolean false.
     *
     * @return TableDiff|false
     *
     * @throws Exception
     */
    public function diffTable(Table $fromTable, Table $toTable)
    {
        $changes                     = 0;
        $tableDifferences            = new TableDiff($fromTable->getName());
        $tableDifferences->fromTable = $fromTable;

        $fromTableColumns = $fromTable->getColumns();
        $toTableColumns   = $toTable->getColumns();

        /* See if all the columns in "from" table exist in "to" table */
        foreach ($toTableColumns as $columnName => $column) {
            if ($fromTable->hasColumn($columnName)) {
                continue;
            }

            $tableDifferences->addedColumns[$columnName] = $column;
            $changes++;
        }

        /* See if there are any removed columns in "to" table */
        foreach ($fromTableColumns as $columnName => $column) {
            // See if column is removed in "to" table.
            if (! $toTable->hasColumn($columnName)) {
                $tableDifferences->removedColumns[$columnName] = $column;
                $changes++;
                continue;
            }

            $toColumn = $toTable->getColumn($columnName);

            // See if column has changed properties in "to" table.
            $changedProperties = $this->diffColumn($column, $toColumn);

            if ($this->platform !== null) {
                if ($this->columnsEqual($column, $toColumn)) {
                    continue;
                }
            } elseif (count($changedProperties) === 0) {
                continue;
            }

            if (empty($changedProperties)) {
                continue;
            }

            $tableDifferences->changedColumns[$column->getName()] = new ColumnDiff(
                $column->getName(),
                $toColumn,
                $changedProperties,
                $column
            );

            $changes++;
        }

        $this->detectColumnRenamings($tableDifferences);

        $fromTableIndexes = $fromTable->getIndexes();
        $toTableIndexes   = $toTable->getIndexes();

        /* See if all the indexes in "from" table exist in "to" table */
        foreach ($toTableIndexes as $indexName => $index) {
            if (($index->isPrimary() && $fromTable->hasPrimaryKey()) || $fromTable->hasIndex($indexName)) {
                continue;
            }

            $tableDifferences->addedIndexes[$indexName] = $index;
            $changes++;
        }

        /* See if there are any removed indexes in "to" table */
        foreach ($fromTableIndexes as $indexName => $index) {
            // See if index is removed in "to" table.
            if (
                ($index->isPrimary() && ! $toTable->hasPrimaryKey()) ||
                ! $index->isPrimary() && ! $toTable->hasIndex($indexName)
            ) {
                $tableDifferences->removedIndexes[$indexName] = $index;
                $changes++;
                continue;
            }

            // See if index has changed in "to" table.
            $toTableIndex = $index->isPrimary() ? $toTable->getPrimaryKey() : $toTable->getIndex($indexName);
            assert($toTableIndex instanceof Index);

            if (! $this->diffIndex($index, $toTableIndex)) {
                continue;
            }

            $tableDifferences->changedIndexes[$indexName] = $toTableIndex;
            $changes++;
        }

        $this->detectIndexRenamings($tableDifferences);

        $fromForeignKeys = $fromTable->getForeignKeys();
        $toForeignKeys   = $toTable->getForeignKeys();

        foreach ($fromForeignKeys as $fromKey => $fromConstraint) {
            foreach ($toForeignKeys as $toKey => $toConstraint) {
                if ($this->diffForeignKey($fromConstraint, $toConstraint) === false) {
                    unset($fromForeignKeys[$fromKey], $toForeignKeys[$toKey]);
                } else {
                    if (strtolower($fromConstraint->getName()) === strtolower($toConstraint->getName())) {
                        $tableDifferences->changedForeignKeys[] = $toConstraint;
                        $changes++;
                        unset($fromForeignKeys[$fromKey], $toForeignKeys[$toKey]);
                    }
                }
            }
        }

        foreach ($fromForeignKeys as $fromConstraint) {
            $tableDifferences->removedForeignKeys[] = $fromConstraint;
            $changes++;
        }

        foreach ($toForeignKeys as $toConstraint) {
            $tableDifferences->addedForeignKeys[] = $toConstraint;
            $changes++;
        }

        return $changes > 0 ? $tableDifferences : false;
    }

    /**
     * Try to find columns that only changed their name, rename operations maybe cheaper than add/drop
     * however ambiguities between different possibilities should not lead to renaming at all.
     */
    private function detectColumnRenamings(TableDiff $tableDifferences): void
    {
        $renameCandidates = [];
        foreach ($tableDifferences->addedColumns as $addedColumnName => $addedColumn) {
            foreach ($tableDifferences->removedColumns as $removedColumn) {
                if (! $this->columnsEqual($addedColumn, $removedColumn)) {
                    continue;
                }

                $renameCandidates[$addedColumn->getName()][] = [$removedColumn, $addedColumn, $addedColumnName];
            }
        }

        foreach ($renameCandidates as $candidateColumns) {
            if (count($candidateColumns) !== 1) {
                continue;
            }

            [$removedColumn, $addedColumn] = $candidateColumns[0];
            $removedColumnName             = $removedColumn->getName();
            $addedColumnName               = strtolower($addedColumn->getName());

            if (isset($tableDifferences->renamedColumns[$removedColumnName])) {
                continue;
            }

            $tableDifferences->renamedColumns[$removedColumnName] = $addedColumn;
            unset(
                $tableDifferences->addedColumns[$addedColumnName],
                $tableDifferences->removedColumns[strtolower($removedColumnName)]
            );
        }
    }

    /**
     * Try to find indexes that only changed their name, rename operations maybe cheaper than add/drop
     * however ambiguities between different possibilities should not lead to renaming at all.
     */
    private function detectIndexRenamings(TableDiff $tableDifferences): void
    {
        $renameCandidates = [];

        // Gather possible rename candidates by comparing each added and removed index based on semantics.
        foreach ($tableDifferences->addedIndexes as $addedIndexName => $addedIndex) {
            foreach ($tableDifferences->removedIndexes as $removedIndex) {
                if ($this->diffIndex($addedIndex, $removedIndex)) {
                    continue;
                }

                $renameCandidates[$addedIndex->getName()][] = [$removedIndex, $addedIndex, $addedIndexName];
            }
        }

        foreach ($renameCandidates as $candidateIndexes) {
            // If the current rename candidate contains exactly one semantically equal index,
            // we can safely rename it.
            // Otherwise it is unclear if a rename action is really intended,
            // therefore we let those ambiguous indexes be added/dropped.
            if (count($candidateIndexes) !== 1) {
                continue;
            }

            [$removedIndex, $addedIndex] = $candidateIndexes[0];

            $removedIndexName = strtolower($removedIndex->getName());
            $addedIndexName   = strtolower($addedIndex->getName());

            if (isset($tableDifferences->renamedIndexes[$removedIndexName])) {
                continue;
            }

            $tableDifferences->renamedIndexes[$removedIndexName] = $addedIndex;
            unset(
                $tableDifferences->addedIndexes[$addedIndexName],
                $tableDifferences->removedIndexes[$removedIndexName]
            );
        }
    }
}
