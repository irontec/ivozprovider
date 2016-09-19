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
class TerminalModels extends ModelAbstract
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
    protected $_iden;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_name;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_description;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_TerminalManufacturerId;

    /**
     * Database var type text
     *
     * @var text
     */
    protected $_genericTemplate;

    /**
     * Database var type text
     *
     * @var text
     */
    protected $_specificTemplate;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_genericUrlPattern;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_specificUrlPattern;


    /**
     * Parent relation TerminalModels_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\TerminalManufacturers
     */
    protected $_TerminalManufacturer;


    /**
     * Dependent relation Terminals_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Terminals[]
     */
    protected $_Terminals;

    protected $_columnsList = array(
        'id'=>'id',
        'iden'=>'iden',
        'name'=>'name',
        'description'=>'description',
        'TerminalManufacturerId'=>'TerminalManufacturerId',
        'genericTemplate'=>'genericTemplate',
        'specificTemplate'=>'specificTemplate',
        'genericUrlPattern'=>'genericUrlPattern',
        'specificUrlPattern'=>'specificUrlPattern',
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
            'TerminalModelsIbfk1'=> array(
                    'property' => 'TerminalManufacturer',
                    'table_name' => 'TerminalManufacturers',
                ),
        ));

        $this->setDependentList(array(
            'TerminalsIbfk1' => array(
                    'property' => 'Terminals',
                    'table_name' => 'Terminals',
                ),
        ));




        $this->_defaultValues = array(
            'name' => '',
            'description' => '',
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
     * @return \IvozProvider\Model\Raw\TerminalModels
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\TerminalModels
     */
    public function setIden($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_iden != $data) {
            $this->_logChange('iden', $this->_iden, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_iden = $data;

        } else if (!is_null($data)) {
            $this->_iden = (string) $data;

        } else {
            $this->_iden = $data;
        }
        return $this;
    }

    /**
     * Gets column iden
     *
     * @return string
     */
    public function getIden()
    {
        return $this->_iden;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\TerminalModels
     */
    public function setName($data)
    {

        if ($this->_name != $data) {
            $this->_logChange('name', $this->_name, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_name = $data;

        } else if (!is_null($data)) {
            $this->_name = (string) $data;

        } else {
            $this->_name = $data;
        }
        return $this;
    }

    /**
     * Gets column name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\TerminalModels
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\TerminalModels
     */
    public function setTerminalManufacturerId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_TerminalManufacturerId != $data) {
            $this->_logChange('TerminalManufacturerId', $this->_TerminalManufacturerId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_TerminalManufacturerId = $data;

        } else if (!is_null($data)) {
            $this->_TerminalManufacturerId = (int) $data;

        } else {
            $this->_TerminalManufacturerId = $data;
        }
        return $this;
    }

    /**
     * Gets column TerminalManufacturerId
     *
     * @return int
     */
    public function getTerminalManufacturerId()
    {
        return $this->_TerminalManufacturerId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param text $data
     * @return \IvozProvider\Model\Raw\TerminalModels
     */
    public function setGenericTemplate($data)
    {

        if ($this->_genericTemplate != $data) {
            $this->_logChange('genericTemplate', $this->_genericTemplate, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_genericTemplate = $data;

        } else if (!is_null($data)) {
            $this->_genericTemplate = (string) $data;

        } else {
            $this->_genericTemplate = $data;
        }
        return $this;
    }

    /**
     * Gets column genericTemplate
     *
     * @return text
     */
    public function getGenericTemplate()
    {
        return $this->_genericTemplate;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param text $data
     * @return \IvozProvider\Model\Raw\TerminalModels
     */
    public function setSpecificTemplate($data)
    {

        if ($this->_specificTemplate != $data) {
            $this->_logChange('specificTemplate', $this->_specificTemplate, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_specificTemplate = $data;

        } else if (!is_null($data)) {
            $this->_specificTemplate = (string) $data;

        } else {
            $this->_specificTemplate = $data;
        }
        return $this;
    }

    /**
     * Gets column specificTemplate
     *
     * @return text
     */
    public function getSpecificTemplate()
    {
        return $this->_specificTemplate;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\TerminalModels
     */
    public function setGenericUrlPattern($data)
    {

        if ($this->_genericUrlPattern != $data) {
            $this->_logChange('genericUrlPattern', $this->_genericUrlPattern, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_genericUrlPattern = $data;

        } else if (!is_null($data)) {
            $this->_genericUrlPattern = (string) $data;

        } else {
            $this->_genericUrlPattern = $data;
        }
        return $this;
    }

    /**
     * Gets column genericUrlPattern
     *
     * @return string
     */
    public function getGenericUrlPattern()
    {
        return $this->_genericUrlPattern;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\TerminalModels
     */
    public function setSpecificUrlPattern($data)
    {

        if ($this->_specificUrlPattern != $data) {
            $this->_logChange('specificUrlPattern', $this->_specificUrlPattern, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_specificUrlPattern = $data;

        } else if (!is_null($data)) {
            $this->_specificUrlPattern = (string) $data;

        } else {
            $this->_specificUrlPattern = $data;
        }
        return $this;
    }

    /**
     * Gets column specificUrlPattern
     *
     * @return string
     */
    public function getSpecificUrlPattern()
    {
        return $this->_specificUrlPattern;
    }

    /**
     * Sets parent relation TerminalManufacturer
     *
     * @param \IvozProvider\Model\Raw\TerminalManufacturers $data
     * @return \IvozProvider\Model\Raw\TerminalModels
     */
    public function setTerminalManufacturer(\IvozProvider\Model\Raw\TerminalManufacturers $data)
    {
        $this->_TerminalManufacturer = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setTerminalManufacturerId($primaryKey);
        }

        $this->_setLoaded('TerminalModelsIbfk1');
        return $this;
    }

    /**
     * Gets parent TerminalManufacturer
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\TerminalManufacturers
     */
    public function getTerminalManufacturer($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'TerminalModelsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_TerminalManufacturer = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_TerminalManufacturer;
    }

    /**
     * Sets dependent relations Terminals_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Terminals
     * @return \IvozProvider\Model\Raw\TerminalModels
     */
    public function setTerminals(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Terminals === null) {

                $this->getTerminals();
            }

            $oldRelations = $this->_Terminals;

            if (is_array($oldRelations)) {

                $dataPKs = array();

                foreach ($data as $newItem) {

                    $pk = $newItem->getPrimaryKey();
                    if (!empty($pk)) {
                        $dataPKs[] = $pk;
                    }
                }

                foreach ($oldRelations as $oldItem) {

                    if (!in_array($oldItem->getPrimaryKey(), $dataPKs)) {

                        $this->_orphans[] = $oldItem;
                    }
                }
            }
        }

        $this->_Terminals = array();

        foreach ($data as $object) {
            $this->addTerminals($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Terminals_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\Terminals $data
     * @return \IvozProvider\Model\Raw\TerminalModels
     */
    public function addTerminals(\IvozProvider\Model\Raw\Terminals $data)
    {
        $this->_Terminals[] = $data;
        $this->_setLoaded('TerminalsIbfk1');
        return $this;
    }

    /**
     * Gets dependent Terminals_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Terminals
     */
    public function getTerminals($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'TerminalsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Terminals = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Terminals;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\TerminalModels
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\TerminalModels')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\TerminalModels);

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
     * @return null | \IvozProvider\Model\Validator\TerminalModels
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\TerminalModels')) {

                $this->setValidator(new \IvozProvider\Validator\TerminalModels);
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
     * @see \Mapper\Sql\TerminalModels::delete
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