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
 * [entity]
 *
 * @package Oasis\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace Oasis\Model\Raw;
class KamTrunksLcrRule extends ModelAbstract
{


    /**
     * Database var type int
     *
     * @var int
     */
    protected $_id;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_lcrId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_prefix;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_fromUri;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_requestUri;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_stopper;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_enabled;


    /**
     * Parent relation kam_trunks_lcr_rule_ibfk_1
     *
     * @var \Oasis\Model\Raw\Brands
     */
    protected $_Lcr;



    protected $_columnsList = array(
        'id'=>'id',
        'lcr_id'=>'lcrId',
        'prefix'=>'prefix',
        'from_uri'=>'fromUri',
        'request_uri'=>'requestUri',
        'stopper'=>'stopper',
        'enabled'=>'enabled',
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
            'KamTrunksLcrRuleIbfk1'=> array(
                    'property' => 'Lcr',
                    'table_name' => 'Brands',
                ),
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
            'stopper' => '0',
            'enabled' => '1',
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
     * @return \Oasis\Model\Raw\KamTrunksLcrRule
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
     * @param int $data
     * @return \Oasis\Model\Raw\KamTrunksLcrRule
     */
    public function setLcrId($data)
    {


        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_lcrId != $data) {
            $this->_logChange('lcrId');
        }

        if (!is_null($data)) {
            $this->_lcrId = (int) $data;
        } else {
            $this->_lcrId = $data;
        }
        return $this;
    }

    /**
     * Gets column lcr_id
     *
     * @return int
     */
    public function getLcrId()
    {
            return $this->_lcrId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksLcrRule
     */
    public function setPrefix($data)
    {

        if ($this->_prefix != $data) {
            $this->_logChange('prefix');
        }

        if (!is_null($data)) {
            $this->_prefix = (string) $data;
        } else {
            $this->_prefix = $data;
        }
        return $this;
    }

    /**
     * Gets column prefix
     *
     * @return string
     */
    public function getPrefix()
    {
            return $this->_prefix;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksLcrRule
     */
    public function setFromUri($data)
    {

        if ($this->_fromUri != $data) {
            $this->_logChange('fromUri');
        }

        if (!is_null($data)) {
            $this->_fromUri = (string) $data;
        } else {
            $this->_fromUri = $data;
        }
        return $this;
    }

    /**
     * Gets column from_uri
     *
     * @return string
     */
    public function getFromUri()
    {
            return $this->_fromUri;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\KamTrunksLcrRule
     */
    public function setRequestUri($data)
    {

        if ($this->_requestUri != $data) {
            $this->_logChange('requestUri');
        }

        if (!is_null($data)) {
            $this->_requestUri = (string) $data;
        } else {
            $this->_requestUri = $data;
        }
        return $this;
    }

    /**
     * Gets column request_uri
     *
     * @return string
     */
    public function getRequestUri()
    {
            return $this->_requestUri;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamTrunksLcrRule
     */
    public function setStopper($data)
    {

        if ($this->_stopper != $data) {
            $this->_logChange('stopper');
        }

        if (!is_null($data)) {
            $this->_stopper = (int) $data;
        } else {
            $this->_stopper = $data;
        }
        return $this;
    }

    /**
     * Gets column stopper
     *
     * @return int
     */
    public function getStopper()
    {
            return $this->_stopper;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\KamTrunksLcrRule
     */
    public function setEnabled($data)
    {

        if ($this->_enabled != $data) {
            $this->_logChange('enabled');
        }

        if (!is_null($data)) {
            $this->_enabled = (int) $data;
        } else {
            $this->_enabled = $data;
        }
        return $this;
    }

    /**
     * Gets column enabled
     *
     * @return int
     */
    public function getEnabled()
    {
            return $this->_enabled;
    }


    /**
     * Sets parent relation Lcr
     *
     * @param \Oasis\Model\Raw\Brands $data
     * @return \Oasis\Model\Raw\KamTrunksLcrRule
     */
    public function setLcr(\Oasis\Model\Raw\Brands $data)
    {
        $this->_Lcr = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['iden'];
        }

        if (!is_null($primaryKey)) {
            $this->setLcrId($primaryKey);
        }

        $this->_setLoaded('KamTrunksLcrRuleIbfk1');
        return $this;
    }

    /**
     * Gets parent Lcr
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Oasis\Model\Raw\Brands
     */
    public function getLcr($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamTrunksLcrRuleIbfk1';

        if (!$avoidLoading && !$this->_isLoaded($fkName)) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Lcr = array_shift($related);
            $this->_setLoaded($fkName);
        }

        return $this->_Lcr;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\KamTrunksLcrRule
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\KamTrunksLcrRule')) {

                $this->setMapper(new \Oasis\Mapper\Sql\KamTrunksLcrRule);

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
     * @return null | \Oasis\Model\Validator\KamTrunksLcrRule
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\KamTrunksLcrRule')) {

                $this->setValidator(new \Oasis\Validator\KamTrunksLcrRule);
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
     * @see \Mapper\Sql\KamTrunksLcrRule::delete
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
}
