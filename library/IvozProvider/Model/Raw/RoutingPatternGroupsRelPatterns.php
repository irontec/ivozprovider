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
class RoutingPatternGroupsRelPatterns extends ModelAbstract
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
    protected $_routingPatternId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_routingPatternGroupId;


    /**
     * Parent relation RoutingPatternGroupsRelPatterns_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\RoutingPatterns
     */
    protected $_RoutingPattern;

    /**
     * Parent relation RoutingPatternGroupsRelPatterns_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\RoutingPatternGroups
     */
    protected $_RoutingPatternGroup;


    protected $_columnsList = array(
        'id'=>'id',
        'routingPatternId'=>'routingPatternId',
        'routingPatternGroupId'=>'routingPatternGroupId',
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
            'RoutingPatternGroupsRelPatternsIbfk1'=> array(
                    'property' => 'RoutingPattern',
                    'table_name' => 'RoutingPatterns',
                ),
            'RoutingPatternGroupsRelPatternsIbfk2'=> array(
                    'property' => 'RoutingPatternGroup',
                    'table_name' => 'RoutingPatternGroups',
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\RoutingPatternGroupsRelPatterns
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\RoutingPatternGroupsRelPatterns
     */
    public function setRoutingPatternId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_routingPatternId != $data) {
            $this->_logChange('routingPatternId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_routingPatternId = $data;

        } else if (!is_null($data)) {
            $this->_routingPatternId = (int) $data;

        } else {
            $this->_routingPatternId = $data;
        }
        return $this;
    }

    /**
     * Gets column routingPatternId
     *
     * @return int
     */
    public function getRoutingPatternId()
    {
        return $this->_routingPatternId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\RoutingPatternGroupsRelPatterns
     */
    public function setRoutingPatternGroupId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_routingPatternGroupId != $data) {
            $this->_logChange('routingPatternGroupId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_routingPatternGroupId = $data;

        } else if (!is_null($data)) {
            $this->_routingPatternGroupId = (int) $data;

        } else {
            $this->_routingPatternGroupId = $data;
        }
        return $this;
    }

    /**
     * Gets column routingPatternGroupId
     *
     * @return int
     */
    public function getRoutingPatternGroupId()
    {
        return $this->_routingPatternGroupId;
    }

    /**
     * Sets parent relation RoutingPattern
     *
     * @param \IvozProvider\Model\Raw\RoutingPatterns $data
     * @return \IvozProvider\Model\Raw\RoutingPatternGroupsRelPatterns
     */
    public function setRoutingPattern(\IvozProvider\Model\Raw\RoutingPatterns $data)
    {
        $this->_RoutingPattern = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setRoutingPatternId($primaryKey);
        }

        $this->_setLoaded('RoutingPatternGroupsRelPatternsIbfk1');
        return $this;
    }

    /**
     * Gets parent RoutingPattern
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\RoutingPatterns
     */
    public function getRoutingPattern($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'RoutingPatternGroupsRelPatternsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_RoutingPattern = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_RoutingPattern;
    }

    /**
     * Sets parent relation RoutingPatternGroup
     *
     * @param \IvozProvider\Model\Raw\RoutingPatternGroups $data
     * @return \IvozProvider\Model\Raw\RoutingPatternGroupsRelPatterns
     */
    public function setRoutingPatternGroup(\IvozProvider\Model\Raw\RoutingPatternGroups $data)
    {
        $this->_RoutingPatternGroup = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setRoutingPatternGroupId($primaryKey);
        }

        $this->_setLoaded('RoutingPatternGroupsRelPatternsIbfk2');
        return $this;
    }

    /**
     * Gets parent RoutingPatternGroup
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\RoutingPatternGroups
     */
    public function getRoutingPatternGroup($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'RoutingPatternGroupsRelPatternsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_RoutingPatternGroup = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_RoutingPatternGroup;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\RoutingPatternGroupsRelPatterns
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\RoutingPatternGroupsRelPatterns')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\RoutingPatternGroupsRelPatterns);

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
     * @return null | \IvozProvider\Model\Validator\RoutingPatternGroupsRelPatterns
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\RoutingPatternGroupsRelPatterns')) {

                $this->setValidator(new \IvozProvider\Validator\RoutingPatternGroupsRelPatterns);
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
     * @see \Mapper\Sql\RoutingPatternGroupsRelPatterns::delete
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