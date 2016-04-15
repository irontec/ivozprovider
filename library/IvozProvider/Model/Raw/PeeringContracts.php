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
class PeeringContracts extends ModelAbstract
{


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
    protected $_brandId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_description;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_name;

    /**
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_transformationRulesetGroupsTrunksId;


    /**
     * Parent relation PeeringContracts_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Brands
     */
    protected $_Brand;

    /**
     * Parent relation PeeringContracts_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
     */
    protected $_TransformationRulesetGroupsTrunks;


    /**
     * Dependent relation PeerServers_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\PeerServers[]
     */
    protected $_PeerServers;

    /**
     * Dependent relation PeeringContractsRelLcrRules_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\PeeringContractsRelLcrRules[]
     */
    protected $_PeeringContractsRelLcrRules;

    /**
     * Dependent relation kam_trunks_uacreg_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\KamTrunksUacreg[]
     */
    protected $_KamTrunksUacreg;

    protected $_columnsList = array(
        'id'=>'id',
        'brandId'=>'brandId',
        'description'=>'description',
        'name'=>'name',
        'transformationRulesetGroupsTrunksId'=>'transformationRulesetGroupsTrunksId',
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
            'PeeringContractsIbfk1'=> array(
                    'property' => 'Brand',
                    'table_name' => 'Brands',
                ),
            'PeeringContractsIbfk2'=> array(
                    'property' => 'TransformationRulesetGroupsTrunks',
                    'table_name' => 'TransformationRulesetGroupsTrunks',
                ),
        ));

        $this->setDependentList(array(
            'PeerServersIbfk1' => array(
                    'property' => 'PeerServers',
                    'table_name' => 'PeerServers',
                ),
            'PeeringContractsRelLcrRulesIbfk2' => array(
                    'property' => 'PeeringContractsRelLcrRules',
                    'table_name' => 'PeeringContractsRelLcrRules',
                ),
            'KamTrunksUacregIbfk2' => array(
                    'property' => 'KamTrunksUacreg',
                    'table_name' => 'kam_trunks_uacreg',
                ),
        ));

        $this->setOnDeleteCascadeRelationships(array(
            'PeerServers_ibfk_1'
        ));



        $this->_defaultValues = array(
            'description' => '',
            'name' => '',
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
     * @return \IvozProvider\Model\Raw\PeeringContracts
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
     * @return \IvozProvider\Model\Raw\PeeringContracts
     */
    public function setBrandId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_brandId != $data) {
            $this->_logChange('brandId');
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
     * @return \IvozProvider\Model\Raw\PeeringContracts
     */
    public function setDescription($data)
    {

        if ($this->_description != $data) {
            $this->_logChange('description');
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
     * @return \IvozProvider\Model\Raw\PeeringContracts
     */
    public function setName($data)
    {

        if ($this->_name != $data) {
            $this->_logChange('name');
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
     * @param binary $data
     * @return \IvozProvider\Model\Raw\PeeringContracts
     */
    public function setTransformationRulesetGroupsTrunksId($data)
    {

        if ($this->_transformationRulesetGroupsTrunksId != $data) {
            $this->_logChange('transformationRulesetGroupsTrunksId');
        }

        $this->_transformationRulesetGroupsTrunksId = $data;
        return $this;
    }

    /**
     * Gets column transformationRulesetGroupsTrunksId
     *
     * @return binary
     */
    public function getTransformationRulesetGroupsTrunksId()
    {
        return $this->_transformationRulesetGroupsTrunksId;
    }

    /**
     * Sets parent relation Brand
     *
     * @param \IvozProvider\Model\Raw\Brands $data
     * @return \IvozProvider\Model\Raw\PeeringContracts
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

        $this->_setLoaded('PeeringContractsIbfk1');
        return $this;
    }

    /**
     * Gets parent Brand
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function getBrand($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PeeringContractsIbfk1';

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
     * Sets parent relation TransformationRulesetGroupsTrunks
     *
     * @param \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks $data
     * @return \IvozProvider\Model\Raw\PeeringContracts
     */
    public function setTransformationRulesetGroupsTrunks(\IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks $data)
    {
        $this->_TransformationRulesetGroupsTrunks = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setTransformationRulesetGroupsTrunksId($primaryKey);
        }

        $this->_setLoaded('PeeringContractsIbfk2');
        return $this;
    }

    /**
     * Gets parent TransformationRulesetGroupsTrunks
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
     */
    public function getTransformationRulesetGroupsTrunks($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PeeringContractsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_TransformationRulesetGroupsTrunks = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_TransformationRulesetGroupsTrunks;
    }

    /**
     * Sets dependent relations PeerServers_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\PeerServers
     * @return \IvozProvider\Model\Raw\PeeringContracts
     */
    public function setPeerServers(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_PeerServers === null) {

                $this->getPeerServers();
            }

            $oldRelations = $this->_PeerServers;

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

        $this->_PeerServers = array();

        foreach ($data as $object) {
            $this->addPeerServers($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations PeerServers_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\PeerServers $data
     * @return \IvozProvider\Model\Raw\PeeringContracts
     */
    public function addPeerServers(\IvozProvider\Model\Raw\PeerServers $data)
    {
        $this->_PeerServers[] = $data;
        $this->_setLoaded('PeerServersIbfk1');
        return $this;
    }

    /**
     * Gets dependent PeerServers_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\PeerServers
     */
    public function getPeerServers($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PeerServersIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_PeerServers = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_PeerServers;
    }

    /**
     * Sets dependent relations PeeringContractsRelLcrRules_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\PeeringContractsRelLcrRules
     * @return \IvozProvider\Model\Raw\PeeringContracts
     */
    public function setPeeringContractsRelLcrRules(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_PeeringContractsRelLcrRules === null) {

                $this->getPeeringContractsRelLcrRules();
            }

            $oldRelations = $this->_PeeringContractsRelLcrRules;

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

        $this->_PeeringContractsRelLcrRules = array();

        foreach ($data as $object) {
            $this->addPeeringContractsRelLcrRules($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations PeeringContractsRelLcrRules_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\PeeringContractsRelLcrRules $data
     * @return \IvozProvider\Model\Raw\PeeringContracts
     */
    public function addPeeringContractsRelLcrRules(\IvozProvider\Model\Raw\PeeringContractsRelLcrRules $data)
    {
        $this->_PeeringContractsRelLcrRules[] = $data;
        $this->_setLoaded('PeeringContractsRelLcrRulesIbfk2');
        return $this;
    }

    /**
     * Gets dependent PeeringContractsRelLcrRules_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\PeeringContractsRelLcrRules
     */
    public function getPeeringContractsRelLcrRules($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PeeringContractsRelLcrRulesIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_PeeringContractsRelLcrRules = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_PeeringContractsRelLcrRules;
    }

    /**
     * Sets dependent relations kam_trunks_uacreg_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\KamTrunksUacreg
     * @return \IvozProvider\Model\Raw\PeeringContracts
     */
    public function setKamTrunksUacreg(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_KamTrunksUacreg === null) {

                $this->getKamTrunksUacreg();
            }

            $oldRelations = $this->_KamTrunksUacreg;

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

        $this->_KamTrunksUacreg = array();

        foreach ($data as $object) {
            $this->addKamTrunksUacreg($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations kam_trunks_uacreg_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\KamTrunksUacreg $data
     * @return \IvozProvider\Model\Raw\PeeringContracts
     */
    public function addKamTrunksUacreg(\IvozProvider\Model\Raw\KamTrunksUacreg $data)
    {
        $this->_KamTrunksUacreg[] = $data;
        $this->_setLoaded('KamTrunksUacregIbfk2');
        return $this;
    }

    /**
     * Gets dependent kam_trunks_uacreg_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\KamTrunksUacreg
     */
    public function getKamTrunksUacreg($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamTrunksUacregIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_KamTrunksUacreg = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_KamTrunksUacreg;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\PeeringContracts
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\PeeringContracts')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\PeeringContracts);

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
     * @return null | \IvozProvider\Model\Validator\PeeringContracts
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\PeeringContracts')) {

                $this->setValidator(new \IvozProvider\Validator\PeeringContracts);
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
     * @see \Mapper\Sql\PeeringContracts::delete
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