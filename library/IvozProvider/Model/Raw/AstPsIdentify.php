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
 * [entity]
 *
 * @package IvozProvider\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Model\Raw;
class AstPsIdentify extends ModelAbstract
{


    /**
     * [uuid:php]
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_id;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_sorceryId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_endpoint;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_match;



    protected $_columnsList = array(
        'id'=>'id',
        'sorcery_id'=>'sorceryId',
        'endpoint'=>'endpoint',
        'match'=>'match',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'id'=> array('uuid:php'),
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
     * @param binary $data
     * @return \IvozProvider\Model\Raw\AstPsIdentify
     */
    public function setId($data)
    {

        if ($this->_id != $data) {
            $this->_logChange('id');
        }

        $this->_id = $data;
        return $this;
    }

    /**
     * Gets column id
     *
     * @return binary
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsIdentify
     */
    public function setSorceryId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_sorceryId != $data) {
            $this->_logChange('sorceryId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_sorceryId = $data;

        } else if (!is_null($data)) {
            $this->_sorceryId = (string) $data;

        } else {
            $this->_sorceryId = $data;
        }
        return $this;
    }

    /**
     * Gets column sorcery_id
     *
     * @return string
     */
    public function getSorceryId()
    {
        return $this->_sorceryId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsIdentify
     */
    public function setEndpoint($data)
    {

        if ($this->_endpoint != $data) {
            $this->_logChange('endpoint');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_endpoint = $data;

        } else if (!is_null($data)) {
            $this->_endpoint = (string) $data;

        } else {
            $this->_endpoint = $data;
        }
        return $this;
    }

    /**
     * Gets column endpoint
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->_endpoint;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsIdentify
     */
    public function setMatch($data)
    {

        if ($this->_match != $data) {
            $this->_logChange('match');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_match = $data;

        } else if (!is_null($data)) {
            $this->_match = (string) $data;

        } else {
            $this->_match = $data;
        }
        return $this;
    }

    /**
     * Gets column match
     *
     * @return string
     */
    public function getMatch()
    {
        return $this->_match;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\AstPsIdentify
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\AstPsIdentify')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\AstPsIdentify);

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
     * @return null | \IvozProvider\Model\Validator\AstPsIdentify
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\AstPsIdentify')) {

                $this->setValidator(new \IvozProvider\Validator\AstPsIdentify);
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
     * @see \Mapper\Sql\AstPsIdentify::delete
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