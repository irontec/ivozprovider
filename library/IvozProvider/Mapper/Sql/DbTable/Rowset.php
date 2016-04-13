<?php
/**
 * Application Model DbTables
 *
 * @package IvozProvider\Mapper
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Rowset class that uses generated Mappers and Models to load data from DB
 *
 * @package IvozProvider\Mapper\Sql\DbTable
 * @subpackage DbTable
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql\DbTable;
class Rowset extends \Zend_Db_Table_Rowset_Abstract
{
    protected $_rowMapper;
    public function init()
    {
        $table = $this->getTable();
        $rowMapper = $table->getRowMapperClass();
        $this->_rowMapper = new $rowMapper;
    }

    protected function _loadAndReturnRow($position)
    {
        if (!isset($this->_data[$position])) {
            require_once 'Zend/Db/Table/Rowset/Exception.php';
            throw new Zend_Db_Table_Rowset_Exception("Data for provided position does not exist");
        }

        // do we already have a row object for this position?
        if (empty($this->_rows[$position])) {
            $this->_rows[$position] = $this->_rowMapper->loadModel($this->_data[$position]);
        }

        // return the row object
        return $this->_rows[$position];
    }
}