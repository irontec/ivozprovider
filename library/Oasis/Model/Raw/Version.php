<?php

/**
 * Application Model
 *
 * @package Oasis\Model\Raw
 * @subpackage Model
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * 
 *
 * @package Oasis\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace Oasis\Model\Raw;
class Version extends ModelAbstract
{


    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_tableName;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_tableVersion;



    protected $_columnsList = array(
        'table_name'=>'tableName',
        'table_version'=>'tableVersion',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
            'tableVersion' => '0',
        );

        $this->_initFileObjects();
        parent::__construct();
    }

    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }
    /**************************************************************************
    ************************** File System Object (FSO)************************
    ***************************************************************************/

    protected function _initFileObjects()
    {

        return $this;
    }

    public function getFileObjects()
    {

        return array();
    }


    /**************************************************************************
    *********************************** /FSO ***********************************
    ***************************************************************************/

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\Version
     */
    public function setTableName($data)
    {

        if ($this->_tableName != $data) {
            $this->_logChange('tableName');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_tableName = $data;

        } else if (!is_null($data)) {
            $this->_tableName = (string) $data;

        } else {
            $this->_tableName = $data;
        }
        return $this;
    }

    /**
     * Gets column table_name
     *
     * @return string
     */
    public function getTableName()
    {
        return $this->_tableName;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\Version
     */
    public function setTableVersion($data)
    {

        if ($this->_tableVersion != $data) {
            $this->_logChange('tableVersion');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_tableVersion = $data;

        } else if (!is_null($data)) {
            $this->_tableVersion = (int) $data;

        } else {
            $this->_tableVersion = $data;
        }
        return $this;
    }

    /**
     * Gets column table_version
     *
     * @return int
     */
    public function getTableVersion()
    {
        return $this->_tableVersion;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\Version
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\Version')) {

                $this->setMapper(new \Oasis\Mapper\Sql\Version);

            } else {

                 new \Exception("Not a valid mapper class found");
            }

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(false);
        }

        return $this->_mapper;
    }

    /**
     * Returns the validator class for this model
     *
     * @return null | \Oasis\Model\Validator\Version
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\Version')) {

                $this->setValidator(new \Oasis\Validator\Version);
            }
        }

        return $this->_validator;
    }

    public function setFromArray($data)
    {
        return $this->getMapper()->loadModel($data, $this);
    }

    /**
     * Deletes current row by deleting the row that matches the primary key
     *
     * @see \Mapper\Sql\Version::delete
     * @return int|boolean Number of rows deleted or boolean if doing soft delete
     */
    public function deleteRowByPrimaryKey()
    {
        if ($this->getTableName() === null) {
            $this->_logger->log('The value for TableName cannot be null in deleteRowByPrimaryKey for ' . get_class($this), \Zend_Log::ERR);
            throw new \Exception('Primary Key does not contain a value');
        }

        return $this->getMapper()->getDbTable()->delete(
            'table_name = ' .
             $this->getMapper()->getDbTable()->getAdapter()->quote($this->getTableName())
        );
    }

    public function mustUpdateEtag()
    {
        return true;
    }

}