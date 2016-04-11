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
class AstExtensions extends ModelAbstract
{


    /**
     * Database var type bigint
     *
     * @var int
     */
    protected $_id;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_context;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_exten;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_priority;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_app;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_appdata;




    protected $_columnsList = array(
        'id'=>'id',
        'context'=>'context',
        'exten'=>'exten',
        'priority'=>'priority',
        'app'=>'app',
        'appdata'=>'appdata',
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
     * @param int $data
     * @return \Oasis\Model\Raw\AstExtensions
     */
    public function setId($data)
    {

        if ($this->_id != $data) {
            $this->_logChange('id');
        }

        if (!is_null($data)) {
            $this->_id = (int) $data;
        } else {
            $this->_id = $data;
        }
        return $this;
    }

    /**
     * Gets column id
     *
     * @return int
     */
    public function getId()
    {
            return $this->_id;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstExtensions
     */
    public function setContext($data)
    {

        if ($this->_context != $data) {
            $this->_logChange('context');
        }

        if (!is_null($data)) {
            $this->_context = (string) $data;
        } else {
            $this->_context = $data;
        }
        return $this;
    }

    /**
     * Gets column context
     *
     * @return string
     */
    public function getContext()
    {
            return $this->_context;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstExtensions
     */
    public function setExten($data)
    {

        if ($this->_exten != $data) {
            $this->_logChange('exten');
        }

        if (!is_null($data)) {
            $this->_exten = (string) $data;
        } else {
            $this->_exten = $data;
        }
        return $this;
    }

    /**
     * Gets column exten
     *
     * @return string
     */
    public function getExten()
    {
            return $this->_exten;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstExtensions
     */
    public function setPriority($data)
    {

        if ($this->_priority != $data) {
            $this->_logChange('priority');
        }

        if (!is_null($data)) {
            $this->_priority = (int) $data;
        } else {
            $this->_priority = $data;
        }
        return $this;
    }

    /**
     * Gets column priority
     *
     * @return int
     */
    public function getPriority()
    {
            return $this->_priority;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstExtensions
     */
    public function setApp($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_app != $data) {
            $this->_logChange('app');
        }

        if (!is_null($data)) {
            $this->_app = (string) $data;
        } else {
            $this->_app = $data;
        }
        return $this;
    }

    /**
     * Gets column app
     *
     * @return string
     */
    public function getApp()
    {
            return $this->_app;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstExtensions
     */
    public function setAppdata($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_appdata != $data) {
            $this->_logChange('appdata');
        }

        if (!is_null($data)) {
            $this->_appdata = (string) $data;
        } else {
            $this->_appdata = $data;
        }
        return $this;
    }

    /**
     * Gets column appdata
     *
     * @return string
     */
    public function getAppdata()
    {
            return $this->_appdata;
    }


    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\AstExtensions
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\AstExtensions')) {

                $this->setMapper(new \Oasis\Mapper\Sql\AstExtensions);

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
     * @return null | \Oasis\Model\Validator\AstExtensions
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\AstExtensions')) {

                $this->setValidator(new \Oasis\Validator\AstExtensions);
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
     * @see \Mapper\Sql\AstExtensions::delete
     * @return int|boolean Number of rows deleted or boolean if doing soft delete
     */
    public function deleteRowByPrimaryKey()
    {
        $primaryKey = array();
        if (!$this->getId()) {
            $this->_logger->log('The value for Id cannot be empty in deleteRowByPrimaryKey for ' . get_class($this), \Zend_Log::ERR);
            throw new \Exception('Primary Key Id does not contain a value');
        } else {
            $primaryKey['id'] = $this->getId();
        }

        if (!$this->getContext()) {
            $this->_logger->log('The value for Context cannot be empty in deleteRowByPrimaryKey for ' . get_class($this), \Zend_Log::ERR);
            throw new \Exception('Primary Key Context does not contain a value');
        } else {
            $primaryKey['context'] = $this->getContext();
        }

        if (!$this->getExten()) {
            $this->_logger->log('The value for Exten cannot be empty in deleteRowByPrimaryKey for ' . get_class($this), \Zend_Log::ERR);
            throw new \Exception('Primary Key Exten does not contain a value');
        } else {
            $primaryKey['exten'] = $this->getExten();
        }

        if (!$this->getPriority()) {
            $this->_logger->log('The value for Priority cannot be empty in deleteRowByPrimaryKey for ' . get_class($this), \Zend_Log::ERR);
            throw new \Exception('Primary Key Priority does not contain a value');
        } else {
            $primaryKey['priority'] = $this->getPriority();
        }

        return $this->getMapper()->getDbTable()->delete('id = '
                    . $this->getMapper()->getDbTable()->getAdapter()->quote($primaryKey['id'])
                    . ' AND context = '
                    . $this->getMapper()->getDbTable()->getAdapter()->quote($primaryKey['context'])
                    . ' AND exten = '
                    . $this->getMapper()->getDbTable()->getAdapter()->quote($primaryKey['exten'])
                    . ' AND priority = '
                    . $this->getMapper()->getDbTable()->getAdapter()->quote($primaryKey['priority']));
    }
}
