<?php
/**
 * Application Model DbTables
 *
 * @package IvozProvider\Model
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Abstract class that is extended by all tables
 *
 * @package IvozProvider\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql\DbTable;
abstract class TableAbstract extends \Zend_Db_Table_Abstract
{
    /**
     * $_name - Name of database table
     *
     * @return string
     */
    protected $_name;

    protected $_rowsetClass = 'IvozProvider\\Mapper\\Sql\\DbTable\\Rowset';

    /**
     * $_id - The primary key name(s)
     *
     * @return string|array
     */
    protected $_id;

    /**
     * Returns the primary key column name(s)
     *
     * @return string|array
     */
    public function getPrimaryKeyName()
    {
        return $this->_id;
    }

    /**
     * Returns the table name
     *
     * @return string
     */
    public function getTableName()
    {
        return $this->_name;
    }

    public function addReferenceMapEntry($key, $value)
    {
        $this->_referenceMap[$key] = $value;
    }

    /**
     * Returns the number of rows in the table
     *
     * @param $estimated bool true if an estimated value is enough (use explain rows value)
     * @return int
     */
    public function countAllRows($estimated = false)
    {
        $query = $this->_getCountQuery();
        if ($estimated) {
            $row = $this->getAdapter()->query('EXPLAIN ' . $query)->fetch();
            return (int) $row['rows'];
        } else {
            $row = $this->getAdapter()->query($query)->fetch();
            return (int) $row['all_count'];
        }
    }

    /**
     * Returns the number of rows in the table with optional WHERE clause
     *
     * @param $where string Where clause to use with the query
     * @return int
     */
    public function countByQuery($where = null)
    {
        $query = $this->_getCountQuery($where);

        $row = $this->getAdapter()->query($query)->fetch();
        return (int) $row['all_count'];
    }

    public function _getCountQuery($where = null)
    {
        $select = $this->select()->from($this->_name, 'count(*) AS all_count');
        return $this->_applyWhere($select, $where);
    }

    /**
     * Generates a query to fetch a list with the given parameters
     *
     * @param $where string|array Where clause to use with the query.
     *     If $where is a string it will be directly used on the where part
     *     If $where is an associative array, an AND where will be created with
     *         - keys being used as conditions
     *         - values being used bindind values
     *         - ex:
     *             array(
     *                 'field1 > ?' => 5,
     *                 'field2 > ?' => 2
     *             )
     *             ---RESULT---
     *             "field1 > 5 AND field2 > 2"
     *
     *     If $where is an non associative array,
     *         - first position [0] will be the conditions string
     *         - second position [1] will be an array with binding values.
     *         - ex: array('field1 > ? AND field2 > ?)', array(5, 2) ----> "field1 > 5 AND field2 > 2"
     *             array(
     *                 'field1 > ? AND field2 > ?'
     *                 array(5, 2)
     *             )
     *             ---RESULT---
     *             "field1 > 5 AND field2 > 2"
     *
     * @param $order string Order clause to use with the query
     * @param $limit int Maximum number of results
     * @param $offset int Offset for the limited number of results
     * @return Zend_Db_Select
     */
    public function fetchList($where = null, $order = null, $limit = null,
        $offset = null)
    {
        $select = $this->select()->order($order)->limit($limit, $offset);
        return $this->_applyWhere($select, $where);
    }

    /**
     * Applies where part to a Zend_Db_Select object
     * @param \Zend_Db_Select $query
     * @param type $where
     */
    protected function _applyWhere(\Zend_Db_Select $select, $where)
    {
        if (is_array($where) && sizeof($where)) {
            if ($this->_isAssociative($where)) {
                foreach ($where as $cond => $value) {
                    $select->where($cond, $value);
                }
            } else {
                list($where, $bind) = $where;

                $select->where($where);
                $select->bind($bind);
            }
        } else if (!empty($where)) {

            $select->where($where);
        }
        return $select;
    }

    protected function _isAssociative(array $array)
    {
        $keys = array_keys($array);
        foreach ($keys as $key) {
            if (is_string($key)) {
                return true;
            }
        }
    }

    public function getReferenceMap($key)
    {
        if (isset($this->_referenceMap[$key]['columns'])) {
            return $this->_referenceMap[$key]['columns'];
        }
        return null;
    }

    public function getRowMapperClass()
    {
        return $this->_rowMapperClass;
    }

    public function fetchRow($where = null, $order = null, $offset = null)
    {
        if (!($where instanceof \Zend_Db_Table_Select)) {
            $select = $this->select();

            if ($where !== null) {
                $this->_where($select, $where);
            }

            if ($order !== null) {
                $this->_order($select, $order);
            }

            $select->limit(1, ((is_numeric($offset)) ? (int) $offset : null));

        } else {
            $select = $where->limit(1, $where->getPart(\Zend_Db_Select::LIMIT_OFFSET));
        }
        $rows = $this->_fetch($select);

        if (count($rows) == 0) {
            return null;
        }

        $data = array(
            'table'   => $this,
            'data'     => $rows[0],
            'readOnly' => $select->isReadOnly(),
            'stored'  => true
        );

        $rowClass = $this->getRowClass();
        if (!class_exists($rowClass)) {
            require_once 'Zend/Loader.php';
            \Zend_Loader::loadClass($rowClass);
        }
        $row = new $rowClass();
        $row->setFromArray($rows[0]);
        return $row;
    }

    /**
    * Deletes existing rows.
    *

    * @return int          The number of rows deleted.
    */
    public function delete($where)
    {
        if ($this->_oldZend()) {
            return $this->_delete11($where);
        } else {
            return $this->_delete12($where);
        }
    }

    protected function _delete11($where)
    {
        $tableSpec = ($this->_schema ? $this->_schema . '.' : '') . $this->_name;
        return $this->_db->delete($tableSpec, $where);
    }

    protected function _delete12($where)
    {
        $depTables = $this->getDependentTables();
        if (!empty($depTables)) {
            $resultSet = $this->fetchAll($where);
            if (count($resultSet) > 0 ) {
                foreach ($resultSet as $row) {
                    /**
                     * Execute cascading deletes against dependent tables
                     */
                    foreach ($depTables as $tableClass) {
                        $t = self::getTableFromString($tableClass, $this);
                        $t->_cascadeDelete($tableClass, array($row->getPrimaryKey()));
                    }
                }
            }
        }

        $tableSpec = ($this->_schema ? $this->_schema . '.' : '') . $this->_name;
        return $this->_db->delete($tableSpec, $where);
    }

    /**
     * Called by parent table's class during delete() method.
     *
     * @param  string $parentTableClassname
     * @param  array  $primaryKey
     * @return int    Number of affected rows
     */
    public function _cascadeDelete($parentTableClassname, array $primaryKey)
    {
        if ($this->_oldZend()) {
            return $this->_cascadeDelete11($parentTableClassname, $primaryKey);
        } else {
            return $this->_cascadeDelete12($parentTableClassname, $primaryKey);
        }
    }

    protected function _cascadeDelete11($parentTableClassname, array $primaryKey)
    {
        $this->_setupMetadata();
        $rowsAffected = 0;
        foreach ($this->_getReferenceMapNormalized() as $map) {
            if ($map[self::REF_TABLE_CLASS] == $parentTableClassname && isset($map[self::ON_DELETE])) {
                switch ($map[self::ON_DELETE]) {
                    case self::CASCADE:
                        $where = array();
                        for ($i = 0; $i < count($map[self::COLUMNS]); ++$i) {
                            $col = $this->_db->foldCase($map[self::COLUMNS][$i]);
                            $refCol = $this->_db->foldCase($map[self::REF_COLUMNS][$i]);
                            $type = $this->_metadata[$col]['DATA_TYPE'];
                            $where[] = $this->_db->quoteInto(
                                $this->_db->quoteIdentifier($col, true) . ' = ?',
                                $primaryKey[$refCol],
                                $type
                            );
                        }
                        $rowsAffected += $this->delete($where);
                        break;
                    default:
                        // no action
                        break;
                }
            }
        }
        return $rowsAffected;
    }

    protected function _cascadeDelete12($parentTableClassname, array $primaryKey)
    {
        // setup metadata
        $this->_setupMetadata();

        // get this class name
        $thisClass = get_class($this);
        if ($thisClass === 'Zend_Db_Table') {
            $thisClass = $this->_definitionConfigName;
        }

        $rowsAffected = 0;

        foreach ($this->_getReferenceMapNormalized() as $map) {
            if ($map[self::REF_TABLE_CLASS] == $parentTableClassname && isset($map[self::ON_DELETE])) {

                $where = array();

                // CASCADE or CASCADE_RECURSE
                if (in_array($map[self::ON_DELETE], array(self::CASCADE, self::CASCADE_RECURSE))) {
                    for ($i = 0; $i < count($map[self::COLUMNS]); ++$i) {
                        $col = $this->_db->foldCase($map[self::COLUMNS][$i]);
                        $refCol = $this->_db->foldCase($map[self::REF_COLUMNS][$i]);
                        $type = $this->_metadata[$col]['DATA_TYPE'];
                        $where[] = $this->_db->quoteInto(
                            $this->_db->quoteIdentifier($col, true) . ' = ?',
                            $primaryKey[$refCol],
                            $type
                        );
                    }
                }

                // CASCADE_RECURSE
                if ($map[self::ON_DELETE] == self::CASCADE_RECURSE) {

                    /**
                     * Execute cascading deletes against dependent tables
                     */
                    $depTables = $this->getDependentTables();
                    if (!empty($depTables)) {
                        foreach ($depTables as $tableClass) {
                            $t = self::getTableFromString($tableClass, $this);
                            foreach ($this->fetchAll($where) as $depRow) {
                                $rowsAffected += $t->_cascadeDelete($thisClass, array($depRow->getPrimaryKey()));
                            }
                        }
                    }
                }

                // CASCADE or CASCADE_RECURSE
                if (in_array($map[self::ON_DELETE], array(self::CASCADE, self::CASCADE_RECURSE))) {
                    $rowsAffected += $this->delete($where);
                }

            }
        }
        return $rowsAffected;
    }

    protected function _oldZend()
    {
        return \Zend_Version::compareVersion("1.12") !== -1;
    }
}
