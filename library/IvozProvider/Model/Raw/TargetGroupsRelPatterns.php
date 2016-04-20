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
class TargetGroupsRelPatterns extends ModelAbstract
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
    protected $_targetPatternId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_targetGroupId;


    /**
     * Parent relation TargetGroupsRelPatterns_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\TargetPatterns
     */
    protected $_TargetPattern;

    /**
     * Parent relation TargetGroupsRelPatterns_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\TargetGroups
     */
    protected $_TargetGroup;


    protected $_columnsList = array(
        'id'=>'id',
        'targetPatternId'=>'targetPatternId',
        'targetGroupId'=>'targetGroupId',
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
            'TargetGroupsRelPatternsIbfk1'=> array(
                    'property' => 'TargetPattern',
                    'table_name' => 'TargetPatterns',
                ),
            'TargetGroupsRelPatternsIbfk2'=> array(
                    'property' => 'TargetGroup',
                    'table_name' => 'TargetGroups',
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
     * @return \IvozProvider\Model\Raw\TargetGroupsRelPatterns
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
     * @return \IvozProvider\Model\Raw\TargetGroupsRelPatterns
     */
    public function setTargetPatternId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_targetPatternId != $data) {
            $this->_logChange('targetPatternId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_targetPatternId = $data;

        } else if (!is_null($data)) {
            $this->_targetPatternId = (int) $data;

        } else {
            $this->_targetPatternId = $data;
        }
        return $this;
    }

    /**
     * Gets column targetPatternId
     *
     * @return int
     */
    public function getTargetPatternId()
    {
        return $this->_targetPatternId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\TargetGroupsRelPatterns
     */
    public function setTargetGroupId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_targetGroupId != $data) {
            $this->_logChange('targetGroupId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_targetGroupId = $data;

        } else if (!is_null($data)) {
            $this->_targetGroupId = (int) $data;

        } else {
            $this->_targetGroupId = $data;
        }
        return $this;
    }

    /**
     * Gets column targetGroupId
     *
     * @return int
     */
    public function getTargetGroupId()
    {
        return $this->_targetGroupId;
    }

    /**
     * Sets parent relation TargetPattern
     *
     * @param \IvozProvider\Model\Raw\TargetPatterns $data
     * @return \IvozProvider\Model\Raw\TargetGroupsRelPatterns
     */
    public function setTargetPattern(\IvozProvider\Model\Raw\TargetPatterns $data)
    {
        $this->_TargetPattern = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setTargetPatternId($primaryKey);
        }

        $this->_setLoaded('TargetGroupsRelPatternsIbfk1');
        return $this;
    }

    /**
     * Gets parent TargetPattern
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\TargetPatterns
     */
    public function getTargetPattern($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'TargetGroupsRelPatternsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_TargetPattern = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_TargetPattern;
    }

    /**
     * Sets parent relation TargetGroup
     *
     * @param \IvozProvider\Model\Raw\TargetGroups $data
     * @return \IvozProvider\Model\Raw\TargetGroupsRelPatterns
     */
    public function setTargetGroup(\IvozProvider\Model\Raw\TargetGroups $data)
    {
        $this->_TargetGroup = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setTargetGroupId($primaryKey);
        }

        $this->_setLoaded('TargetGroupsRelPatternsIbfk2');
        return $this;
    }

    /**
     * Gets parent TargetGroup
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\TargetGroups
     */
    public function getTargetGroup($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'TargetGroupsRelPatternsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_TargetGroup = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_TargetGroup;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\TargetGroupsRelPatterns
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\TargetGroupsRelPatterns')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\TargetGroupsRelPatterns);

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
     * @return null | \IvozProvider\Model\Validator\TargetGroupsRelPatterns
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\TargetGroupsRelPatterns')) {

                $this->setValidator(new \IvozProvider\Validator\TargetGroupsRelPatterns);
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
     * @see \Mapper\Sql\TargetGroupsRelPatterns::delete
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