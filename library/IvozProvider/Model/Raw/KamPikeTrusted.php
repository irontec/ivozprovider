<?php

/**
 * Application Model
 *
 * @package IvozProvider\Model\Raw
 * @subpackage Model
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * [entity][rest]
 *
 * @package IvozProvider\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Model\Raw;
class KamPikeTrusted extends ModelAbstract
{


    /**
     * Database var type int
     *
     * @var int
     */
    protected $_id;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_srcIp;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_proto;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_fromPattern;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_ruriPattern;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_tag;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_priority;



    protected $_columnsList = array(
        'id'=>'id',
        'src_ip'=>'srcIp',
        'proto'=>'proto',
        'from_pattern'=>'fromPattern',
        'ruri_pattern'=>'ruriPattern',
        'tag'=>'tag',
        'priority'=>'priority',
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
            'priority' => '0',
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
     * @return \IvozProvider\Model\Raw\KamPikeTrusted
     */
    public function setId($data)
    {

        if ($this->_id != $data) {
            $this->_logChange('id');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_id = $data;

        } else if (!is_null($data)) {
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
     * @return \IvozProvider\Model\Raw\KamPikeTrusted
     */
    public function setSrcIp($data)
    {

        if ($this->_srcIp != $data) {
            $this->_logChange('srcIp');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_srcIp = $data;

        } else if (!is_null($data)) {
            $this->_srcIp = (string) $data;

        } else {
            $this->_srcIp = $data;
        }
        return $this;
    }

    /**
     * Gets column src_ip
     *
     * @return string
     */
    public function getSrcIp()
    {
        return $this->_srcIp;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamPikeTrusted
     */
    public function setProto($data)
    {

        if ($this->_proto != $data) {
            $this->_logChange('proto');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_proto = $data;

        } else if (!is_null($data)) {
            $this->_proto = (string) $data;

        } else {
            $this->_proto = $data;
        }
        return $this;
    }

    /**
     * Gets column proto
     *
     * @return string
     */
    public function getProto()
    {
        return $this->_proto;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamPikeTrusted
     */
    public function setFromPattern($data)
    {

        if ($this->_fromPattern != $data) {
            $this->_logChange('fromPattern');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_fromPattern = $data;

        } else if (!is_null($data)) {
            $this->_fromPattern = (string) $data;

        } else {
            $this->_fromPattern = $data;
        }
        return $this;
    }

    /**
     * Gets column from_pattern
     *
     * @return string
     */
    public function getFromPattern()
    {
        return $this->_fromPattern;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamPikeTrusted
     */
    public function setRuriPattern($data)
    {

        if ($this->_ruriPattern != $data) {
            $this->_logChange('ruriPattern');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_ruriPattern = $data;

        } else if (!is_null($data)) {
            $this->_ruriPattern = (string) $data;

        } else {
            $this->_ruriPattern = $data;
        }
        return $this;
    }

    /**
     * Gets column ruri_pattern
     *
     * @return string
     */
    public function getRuriPattern()
    {
        return $this->_ruriPattern;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamPikeTrusted
     */
    public function setTag($data)
    {

        if ($this->_tag != $data) {
            $this->_logChange('tag');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_tag = $data;

        } else if (!is_null($data)) {
            $this->_tag = (string) $data;

        } else {
            $this->_tag = $data;
        }
        return $this;
    }

    /**
     * Gets column tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->_tag;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\KamPikeTrusted
     */
    public function setPriority($data)
    {

        if ($this->_priority != $data) {
            $this->_logChange('priority');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_priority = $data;

        } else if (!is_null($data)) {
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
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\KamPikeTrusted
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\KamPikeTrusted')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\KamPikeTrusted);

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
     * @return null | \IvozProvider\Model\Validator\KamPikeTrusted
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\KamPikeTrusted')) {

                $this->setValidator(new \IvozProvider\Validator\KamPikeTrusted);
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
     * @see \Mapper\Sql\KamPikeTrusted::delete
     * @return int|boolean Number of rows deleted or boolean if doing soft delete
     */
    public function deleteRowByPrimaryKey()
    {
        if ($this->getId() === null) {
            $this->_logger->log('The value for Id cannot be null in deleteRowByPrimaryKey for ' . get_class($this), \Zend_Log::ERR);
            throw new \Exception('Primary Key does not contain a value');
        }

        return $this->getMapper()->getDbTable()->delete(
            'id = ' .
             $this->getMapper()->getDbTable()->getAdapter()->quote($this->getId())
        );
    }

    public function mustUpdateEtag()
    {
        return true;
    }

}