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
class MatchListPatterns extends ModelAbstract
{

    protected $_typeAcceptedValues = array(
        'number',
        'regexp',
    );

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
    protected $_matchListId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_description;

    /**
     * [enum:number|regexp]
     * Database var type varchar
     *
     * @var string
     */
    protected $_type;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_regExp;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_numberCountryId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_numberValue;


    /**
     * Parent relation MatchListPatterns_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\MatchLists
     */
    protected $_MatchList;

    /**
     * Parent relation MatchListPatterns_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\Countries
     */
    protected $_NumberCountry;


    protected $_columnsList = array(
        'id'=>'id',
        'matchListId'=>'matchListId',
        'description'=>'description',
        'type'=>'type',
        'regExp'=>'regExp',
        'numberCountryId'=>'numberCountryId',
        'numberValue'=>'numberValue',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'type'=> array('enum:number|regexp'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'MatchListPatternsIbfk1'=> array(
                    'property' => 'MatchList',
                    'table_name' => 'MatchLists',
                ),
            'MatchListPatternsIbfk2'=> array(
                    'property' => 'NumberCountry',
                    'table_name' => 'Countries',
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
     * @return \IvozProvider\Model\Raw\MatchListPatterns
     */
    public function setId($data)
    {

        if ($this->_id != $data) {
            $this->_logChange('id', $this->_id, $data);
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
     * @return \IvozProvider\Model\Raw\MatchListPatterns
     */
    public function setMatchListId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_matchListId != $data) {
            $this->_logChange('matchListId', $this->_matchListId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_matchListId = $data;

        } else if (!is_null($data)) {
            $this->_matchListId = (int) $data;

        } else {
            $this->_matchListId = $data;
        }
        return $this;
    }

    /**
     * Gets column matchListId
     *
     * @return int
     */
    public function getMatchListId()
    {
        return $this->_matchListId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\MatchListPatterns
     */
    public function setDescription($data)
    {

        if ($this->_description != $data) {
            $this->_logChange('description', $this->_description, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_description = $data;

        } else if (!is_null($data)) {
            $this->_description = (string) $data;

        } else {
            $this->_description = $data;
        }
        return $this;
    }

    /**
     * Gets column description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\MatchListPatterns
     */
    public function setType($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_type != $data) {
            $this->_logChange('type', $this->_type, $data);
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
     * @return \IvozProvider\Model\Raw\MatchListPatterns
     */
    public function setRegExp($data)
    {

        if ($this->_regExp != $data) {
            $this->_logChange('regExp', $this->_regExp, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_regExp = $data;

        } else if (!is_null($data)) {
            $this->_regExp = (string) $data;

        } else {
            $this->_regExp = $data;
        }
        return $this;
    }

    /**
     * Gets column regExp
     *
     * @return string
     */
    public function getRegExp()
    {
        return $this->_regExp;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\MatchListPatterns
     */
    public function setNumberCountryId($data)
    {

        if ($this->_numberCountryId != $data) {
            $this->_logChange('numberCountryId', $this->_numberCountryId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_numberCountryId = $data;

        } else if (!is_null($data)) {
            $this->_numberCountryId = (int) $data;

        } else {
            $this->_numberCountryId = $data;
        }
        return $this;
    }

    /**
     * Gets column numberCountryId
     *
     * @return int
     */
    public function getNumberCountryId()
    {
        return $this->_numberCountryId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\MatchListPatterns
     */
    public function setNumberValue($data)
    {

        if ($this->_numberValue != $data) {
            $this->_logChange('numberValue', $this->_numberValue, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_numberValue = $data;

        } else if (!is_null($data)) {
            $this->_numberValue = (string) $data;

        } else {
            $this->_numberValue = $data;
        }
        return $this;
    }

    /**
     * Gets column numberValue
     *
     * @return string
     */
    public function getNumberValue()
    {
        return $this->_numberValue;
    }

    /**
     * Sets parent relation MatchList
     *
     * @param \IvozProvider\Model\Raw\MatchLists $data
     * @return \IvozProvider\Model\Raw\MatchListPatterns
     */
    public function setMatchList(\IvozProvider\Model\Raw\MatchLists $data)
    {
        $this->_MatchList = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setMatchListId($primaryKey);
        }

        $this->_setLoaded('MatchListPatternsIbfk1');
        return $this;
    }

    /**
     * Gets parent MatchList
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\MatchLists
     */
    public function getMatchList($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'MatchListPatternsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_MatchList = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_MatchList;
    }

    /**
     * Sets parent relation NumberCountry
     *
     * @param \IvozProvider\Model\Raw\Countries $data
     * @return \IvozProvider\Model\Raw\MatchListPatterns
     */
    public function setNumberCountry(\IvozProvider\Model\Raw\Countries $data)
    {
        $this->_NumberCountry = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setNumberCountryId($primaryKey);
        }

        $this->_setLoaded('MatchListPatternsIbfk2');
        return $this;
    }

    /**
     * Gets parent NumberCountry
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function getNumberCountry($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'MatchListPatternsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_NumberCountry = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_NumberCountry;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\MatchListPatterns
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\MatchListPatterns')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\MatchListPatterns);

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
     * @return null | \IvozProvider\Model\Validator\MatchListPatterns
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\MatchListPatterns')) {

                $this->setValidator(new \IvozProvider\Validator\MatchListPatterns);
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
     * @see \Mapper\Sql\MatchListPatterns::delete
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