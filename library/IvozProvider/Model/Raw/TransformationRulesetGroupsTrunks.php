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
class TransformationRulesetGroupsTrunks extends ModelAbstract
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
    protected $_brandId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_name;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_callerIn;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_calleeIn;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_callerOut;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_calleeOut;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_description;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_automatic;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_countryId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_internationalCode;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_nationalNumLength;


    /**
     * Parent relation TransformationRulesetGroupsTrunks_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Brands
     */
    protected $_Brand;

    /**
     * Parent relation TransformationRulesetGroupsTrunks_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\Countries
     */
    protected $_Country;


    /**
     * Dependent relation PeeringContracts_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\PeeringContracts[]
     */
    protected $_PeeringContracts;

    /**
     * Dependent relation kam_trunks_dialplan_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\KamTrunksDialplan[]
     */
    protected $_KamTrunksDialplan;

    protected $_columnsList = array(
        'id'=>'id',
        'brandId'=>'brandId',
        'name'=>'name',
        'caller_in'=>'callerIn',
        'callee_in'=>'calleeIn',
        'caller_out'=>'callerOut',
        'callee_out'=>'calleeOut',
        'description'=>'description',
        'automatic'=>'automatic',
        'countryId'=>'countryId',
        'internationalCode'=>'internationalCode',
        'nationalNumLength'=>'nationalNumLength',
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
            'TransformationRulesetGroupsTrunksIbfk1'=> array(
                    'property' => 'Brand',
                    'table_name' => 'Brands',
                ),
            'TransformationRulesetGroupsTrunksIbfk2'=> array(
                    'property' => 'Country',
                    'table_name' => 'Countries',
                ),
        ));

        $this->setDependentList(array(
            'PeeringContractsIbfk2' => array(
                    'property' => 'PeeringContracts',
                    'table_name' => 'PeeringContracts',
                ),
            'KamTrunksDialplanIbfk2' => array(
                    'property' => 'KamTrunksDialplan',
                    'table_name' => 'kam_trunks_dialplan',
                ),
        ));


        $this->setOnDeleteSetNullRelationships(array(
            'PeeringContracts_ibfk_2'
        ));


        $this->_defaultValues = array(
            'description' => '',
            'automatic' => '0',
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
     * @return \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
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
     * @return \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
     */
    public function setBrandId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_brandId != $data) {
            $this->_logChange('brandId', $this->_brandId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_brandId = $data;

        } else if (!is_null($data)) {
            $this->_brandId = (int) $data;

        } else {
            $this->_brandId = $data;
        }
        return $this;
    }

    /**
     * Gets column brandId
     *
     * @return int
     */
    public function getBrandId()
    {
        return $this->_brandId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
     */
    public function setName($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
     */
    public function setCallerIn($data)
    {

        if ($this->_callerIn != $data) {
            $this->_logChange('callerIn', $this->_callerIn, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_callerIn = $data;

        } else if (!is_null($data)) {
            $this->_callerIn = (int) $data;

        } else {
            $this->_callerIn = $data;
        }
        return $this;
    }

    /**
     * Gets column caller_in
     *
     * @return int
     */
    public function getCallerIn()
    {
        return $this->_callerIn;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
     */
    public function setCalleeIn($data)
    {

        if ($this->_calleeIn != $data) {
            $this->_logChange('calleeIn', $this->_calleeIn, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_calleeIn = $data;

        } else if (!is_null($data)) {
            $this->_calleeIn = (int) $data;

        } else {
            $this->_calleeIn = $data;
        }
        return $this;
    }

    /**
     * Gets column callee_in
     *
     * @return int
     */
    public function getCalleeIn()
    {
        return $this->_calleeIn;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
     */
    public function setCallerOut($data)
    {

        if ($this->_callerOut != $data) {
            $this->_logChange('callerOut', $this->_callerOut, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_callerOut = $data;

        } else if (!is_null($data)) {
            $this->_callerOut = (int) $data;

        } else {
            $this->_callerOut = $data;
        }
        return $this;
    }

    /**
     * Gets column caller_out
     *
     * @return int
     */
    public function getCallerOut()
    {
        return $this->_callerOut;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
     */
    public function setCalleeOut($data)
    {

        if ($this->_calleeOut != $data) {
            $this->_logChange('calleeOut', $this->_calleeOut, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_calleeOut = $data;

        } else if (!is_null($data)) {
            $this->_calleeOut = (int) $data;

        } else {
            $this->_calleeOut = $data;
        }
        return $this;
    }

    /**
     * Gets column callee_out
     *
     * @return int
     */
    public function getCalleeOut()
    {
        return $this->_calleeOut;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
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
     * @return \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
     */
    public function setAutomatic($data)
    {

        if ($this->_automatic != $data) {
            $this->_logChange('automatic', $this->_automatic, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_automatic = $data;

        } else if (!is_null($data)) {
            $this->_automatic = (int) $data;

        } else {
            $this->_automatic = $data;
        }
        return $this;
    }

    /**
     * Gets column automatic
     *
     * @return int
     */
    public function getAutomatic()
    {
        return $this->_automatic;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
     */
    public function setCountryId($data)
    {

        if ($this->_countryId != $data) {
            $this->_logChange('countryId', $this->_countryId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_countryId = $data;

        } else if (!is_null($data)) {
            $this->_countryId = (int) $data;

        } else {
            $this->_countryId = $data;
        }
        return $this;
    }

    /**
     * Gets column countryId
     *
     * @return int
     */
    public function getCountryId()
    {
        return $this->_countryId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
     */
    public function setInternationalCode($data)
    {

        if ($this->_internationalCode != $data) {
            $this->_logChange('internationalCode', $this->_internationalCode, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_internationalCode = $data;

        } else if (!is_null($data)) {
            $this->_internationalCode = (string) $data;

        } else {
            $this->_internationalCode = $data;
        }
        return $this;
    }

    /**
     * Gets column internationalCode
     *
     * @return string
     */
    public function getInternationalCode()
    {
        return $this->_internationalCode;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
     */
    public function setNationalNumLength($data)
    {

        if ($this->_nationalNumLength != $data) {
            $this->_logChange('nationalNumLength', $this->_nationalNumLength, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_nationalNumLength = $data;

        } else if (!is_null($data)) {
            $this->_nationalNumLength = (int) $data;

        } else {
            $this->_nationalNumLength = $data;
        }
        return $this;
    }

    /**
     * Gets column nationalNumLength
     *
     * @return int
     */
    public function getNationalNumLength()
    {
        return $this->_nationalNumLength;
    }

    /**
     * Sets parent relation Brand
     *
     * @param \IvozProvider\Model\Raw\Brands $data
     * @return \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
     */
    public function setBrand(\IvozProvider\Model\Raw\Brands $data)
    {
        $this->_Brand = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setBrandId($primaryKey);
        }

        $this->_setLoaded('TransformationRulesetGroupsTrunksIbfk1');
        return $this;
    }

    /**
     * Gets parent Brand
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function getBrand($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'TransformationRulesetGroupsTrunksIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Brand = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Brand;
    }

    /**
     * Sets parent relation Country
     *
     * @param \IvozProvider\Model\Raw\Countries $data
     * @return \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
     */
    public function setCountry(\IvozProvider\Model\Raw\Countries $data)
    {
        $this->_Country = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setCountryId($primaryKey);
        }

        $this->_setLoaded('TransformationRulesetGroupsTrunksIbfk2');
        return $this;
    }

    /**
     * Gets parent Country
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function getCountry($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'TransformationRulesetGroupsTrunksIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Country = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Country;
    }

    /**
     * Sets dependent relations PeeringContracts_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\PeeringContracts
     * @return \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
     */
    public function setPeeringContracts(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_PeeringContracts === null) {

                $this->getPeeringContracts();
            }

            $oldRelations = $this->_PeeringContracts;

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

        $this->_PeeringContracts = array();

        foreach ($data as $object) {
            $this->addPeeringContracts($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations PeeringContracts_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\PeeringContracts $data
     * @return \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
     */
    public function addPeeringContracts(\IvozProvider\Model\Raw\PeeringContracts $data)
    {
        $this->_PeeringContracts[] = $data;
        $this->_setLoaded('PeeringContractsIbfk2');
        return $this;
    }

    /**
     * Gets dependent PeeringContracts_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\PeeringContracts
     */
    public function getPeeringContracts($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PeeringContractsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_PeeringContracts = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_PeeringContracts;
    }

    /**
     * Sets dependent relations kam_trunks_dialplan_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\KamTrunksDialplan
     * @return \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
     */
    public function setKamTrunksDialplan(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_KamTrunksDialplan === null) {

                $this->getKamTrunksDialplan();
            }

            $oldRelations = $this->_KamTrunksDialplan;

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

        $this->_KamTrunksDialplan = array();

        foreach ($data as $object) {
            $this->addKamTrunksDialplan($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations kam_trunks_dialplan_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\KamTrunksDialplan $data
     * @return \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
     */
    public function addKamTrunksDialplan(\IvozProvider\Model\Raw\KamTrunksDialplan $data)
    {
        $this->_KamTrunksDialplan[] = $data;
        $this->_setLoaded('KamTrunksDialplanIbfk2');
        return $this;
    }

    /**
     * Gets dependent kam_trunks_dialplan_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\KamTrunksDialplan
     */
    public function getKamTrunksDialplan($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamTrunksDialplanIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_KamTrunksDialplan = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_KamTrunksDialplan;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\TransformationRulesetGroupsTrunks
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\TransformationRulesetGroupsTrunks')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\TransformationRulesetGroupsTrunks);

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
     * @return null | \IvozProvider\Model\Validator\TransformationRulesetGroupsTrunks
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\TransformationRulesetGroupsTrunks')) {

                $this->setValidator(new \IvozProvider\Validator\TransformationRulesetGroupsTrunks);
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
     * @see \Mapper\Sql\TransformationRulesetGroupsTrunks::delete
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