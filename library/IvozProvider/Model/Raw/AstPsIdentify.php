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
     * Database var type varchar
     *
     * @var string
     */
    protected $_sorceryId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_proxyTrunkId;

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


    /**
     * Parent relation ast_ps_identify_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\ProxyTrunks
     */
    protected $_ProxyTrunk;


    protected $_columnsList = array(
        'sorcery_id'=>'sorceryId',
        'proxyTrunkId'=>'proxyTrunkId',
        'endpoint'=>'endpoint',
        'match'=>'match',
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
            'AstPsIdentifyIbfk1'=> array(
                    'property' => 'ProxyTrunk',
                    'table_name' => 'ProxyTrunks',
                ),
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsIdentify
     */
    public function setSorceryId($data)
    {

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
     * @param int $data
     * @return \IvozProvider\Model\Raw\AstPsIdentify
     */
    public function setProxyTrunkId($data)
    {

        if ($this->_proxyTrunkId != $data) {
            $this->_logChange('proxyTrunkId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_proxyTrunkId = $data;

        } else if (!is_null($data)) {
            $this->_proxyTrunkId = (int) $data;

        } else {
            $this->_proxyTrunkId = $data;
        }
        return $this;
    }

    /**
     * Gets column proxyTrunkId
     *
     * @return int
     */
    public function getProxyTrunkId()
    {
        return $this->_proxyTrunkId;
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
     * Sets parent relation ProxyTrunk
     *
     * @param \IvozProvider\Model\Raw\ProxyTrunks $data
     * @return \IvozProvider\Model\Raw\AstPsIdentify
     */
    public function setProxyTrunk(\IvozProvider\Model\Raw\ProxyTrunks $data)
    {
        $this->_ProxyTrunk = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setProxyTrunkId($primaryKey);
        }

        $this->_setLoaded('AstPsIdentifyIbfk1');
        return $this;
    }

    /**
     * Gets parent ProxyTrunk
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\ProxyTrunks
     */
    public function getProxyTrunk($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'AstPsIdentifyIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_ProxyTrunk = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_ProxyTrunk;
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
        if ($this->getSorceryId() === null) {
            $this->_logger->log('The value for SorceryId cannot be null in deleteRowByPrimaryKey for ' . get_class($this), \Zend_Log::ERR);
            throw new \Exception('Primary Key does not contain a value');
        }

        return $this->getMapper()->getDbTable()->delete(
            'sorcery_id = ' .
             $this->getMapper()->getDbTable()->getAdapter()->quote($this->getSorceryId())
        );
    }

    public function mustUpdateEtag()
    {
        return true;
    }

}