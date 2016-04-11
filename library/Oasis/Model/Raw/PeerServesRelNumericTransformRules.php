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
class PeerServesRelNumericTransformRules extends ModelAbstract
{

    protected $_typeAcceptedValues = array(
        'incoming',
        'outgoing',
        'both',
    );
    protected $_applyToAcceptedValues = array(
        'requestURI',
        'callerId',
    );

    /**
     * [uuid:php]
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_id;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_peerServerId;

    /**
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_numericTransformRuleId;

    /**
     * [enum:incoming|outgoing|both]
     * Database var type varchar
     *
     * @var string
     */
    protected $_type;

    /**
     * [enum:requestURI|callerId]
     * Database var type varchar
     *
     * @var string
     */
    protected $_applyTo;


    /**
     * Parent relation PeerServesRelNumericTransformRules_ibfk_3
     *
     * @var \Oasis\Model\Raw\PeerServers
     */
    protected $_PeerServer;

    /**
     * Parent relation PeerServesRelNumericTransformRules_ibfk_2
     *
     * @var \Oasis\Model\Raw\NumericTransformRules
     */
    protected $_NumericTransformRule;



    protected $_columnsList = array(
        'id'=>'id',
        'peerServerId'=>'peerServerId',
        'numericTransformRuleId'=>'numericTransformRuleId',
        'type'=>'type',
        'applyTo'=>'applyTo',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'id'=> array('uuid:php'),
            'type'=> array('enum:incoming|outgoing|both'),
            'applyTo'=> array('enum:requestURI|callerId'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'PeerServesRelNumericTransformRulesIbfk3'=> array(
                    'property' => 'PeerServer',
                    'table_name' => 'PeerServers',
                ),
            'PeerServesRelNumericTransformRulesIbfk2'=> array(
                    'property' => 'NumericTransformRule',
                    'table_name' => 'NumericTransformRules',
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
     * @param binary $data
     * @return \Oasis\Model\Raw\PeerServesRelNumericTransformRules
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
     * @param int $data
     * @return \Oasis\Model\Raw\PeerServesRelNumericTransformRules
     */
    public function setPeerServerId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }

        if ($this->_peerServerId != $data) {
            $this->_logChange('peerServerId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_peerServerId = $data;
        } else if (!is_null($data)) {
            $this->_peerServerId = (int) $data;
        } else {
            $this->_peerServerId = $data;
        }
        return $this;
    }

    /**
     * Gets column peerServerId
     *
     * @return int
     */
    public function getPeerServerId()
    {
            return $this->_peerServerId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param binary $data
     * @return \Oasis\Model\Raw\PeerServesRelNumericTransformRules
     */
    public function setNumericTransformRuleId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }

        if ($this->_numericTransformRuleId != $data) {
            $this->_logChange('numericTransformRuleId');
        }


        $this->_numericTransformRuleId = $data;
        return $this;
    }

    /**
     * Gets column numericTransformRuleId
     *
     * @return binary
     */
    public function getNumericTransformRuleId()
    {
            return $this->_numericTransformRuleId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\PeerServesRelNumericTransformRules
     */
    public function setType($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }

        if ($this->_type != $data) {
            $this->_logChange('type');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_type = $data;
        } else if (!is_null($data)) {
            if (!in_array($data, $this->_typeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for type'));
            }
            $this->_type = (string) $data;
        } else {
            $this->_type = $data;
        }
        return $this;
    }

    /**
     * Gets column type
     *
     * @return string
     */
    public function getType()
    {
            return $this->_type;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\PeerServesRelNumericTransformRules
     */
    public function setApplyTo($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }

        if ($this->_applyTo != $data) {
            $this->_logChange('applyTo');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_applyTo = $data;
        } else if (!is_null($data)) {
            if (!in_array($data, $this->_applyToAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for applyTo'));
            }
            $this->_applyTo = (string) $data;
        } else {
            $this->_applyTo = $data;
        }
        return $this;
    }

    /**
     * Gets column applyTo
     *
     * @return string
     */
    public function getApplyTo()
    {
            return $this->_applyTo;
    }


    /**
     * Sets parent relation PeerServer
     *
     * @param \Oasis\Model\Raw\PeerServers $data
     * @return \Oasis\Model\Raw\PeerServesRelNumericTransformRules
     */
    public function setPeerServer(\Oasis\Model\Raw\PeerServers $data)
    {
        $this->_PeerServer = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setPeerServerId($primaryKey);
        }

        $this->_setLoaded('PeerServesRelNumericTransformRulesIbfk3');
        return $this;
    }

    /**
     * Gets parent PeerServer
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Oasis\Model\Raw\PeerServers
     */
    public function getPeerServer($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PeerServesRelNumericTransformRulesIbfk3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_PeerServer = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_PeerServer;
    }

    /**
     * Sets parent relation NumericTransformRule
     *
     * @param \Oasis\Model\Raw\NumericTransformRules $data
     * @return \Oasis\Model\Raw\PeerServesRelNumericTransformRules
     */
    public function setNumericTransformRule(\Oasis\Model\Raw\NumericTransformRules $data)
    {
        $this->_NumericTransformRule = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setNumericTransformRuleId($primaryKey);
        }

        $this->_setLoaded('PeerServesRelNumericTransformRulesIbfk2');
        return $this;
    }

    /**
     * Gets parent NumericTransformRule
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Oasis\Model\Raw\NumericTransformRules
     */
    public function getNumericTransformRule($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PeerServesRelNumericTransformRulesIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_NumericTransformRule = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_NumericTransformRule;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\PeerServesRelNumericTransformRules
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\PeerServesRelNumericTransformRules')) {

                $this->setMapper(new \Oasis\Mapper\Sql\PeerServesRelNumericTransformRules);

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
     * @return null | \Oasis\Model\Validator\PeerServesRelNumericTransformRules
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\PeerServesRelNumericTransformRules')) {

                $this->setValidator(new \Oasis\Validator\PeerServesRelNumericTransformRules);
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
     * @see \Mapper\Sql\PeerServesRelNumericTransformRules::delete
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
