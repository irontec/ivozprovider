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
class PeeringContracts extends ModelAbstract
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
    protected $_description;

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
    protected $_transformationRulesetGroupsTrunksId;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_externallyRated;


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
     * Dependent relation DDIs_ibfk_8
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\DDIs[]
     */
    protected $_DDIs;

    /**
     * Dependent relation OutgoingRouting_ibfk_5
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\OutgoingRouting[]
     */
    protected $_OutgoingRouting;

    /**
     * Dependent relation parsedCDRs_ibfk_6
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\ParsedCDRs[]
     */
    protected $_ParsedCDRs;

    /**
     * Dependent relation PeerServers_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\PeerServers[]
     */
    protected $_PeerServers;

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
        'externallyRated'=>'externallyRated',
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
            'DDIsIbfk8' => array(
                    'property' => 'DDIs',
                    'table_name' => 'DDIs',
                ),
            'OutgoingRoutingIbfk5' => array(
                    'property' => 'OutgoingRouting',
                    'table_name' => 'OutgoingRouting',
                ),
            'ParsedCDRsIbfk6' => array(
                    'property' => 'ParsedCDRs',
                    'table_name' => 'ParsedCDRs',
                ),
            'PeerServersIbfk1' => array(
                    'property' => 'PeerServers',
                    'table_name' => 'PeerServers',
                ),
            'KamTrunksUacregIbfk2' => array(
                    'property' => 'KamTrunksUacreg',
                    'table_name' => 'kam_trunks_uacreg',
                ),
        ));

        $this->setOnDeleteCascadeRelationships(array(
            'OutgoingRouting_ibfk_5',
            'PeerServers_ibfk_1'
        ));

        $this->setOnDeleteSetNullRelationships(array(
            'DDIs_ibfk_8',
            'parsedCDRs_ibfk_6'
        ));


        $this->_defaultValues = array(
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
     * @return \IvozProvider\Model\Raw\PeeringContracts
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
     * @return \IvozProvider\Model\Raw\PeeringContracts
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
     * @return \IvozProvider\Model\Raw\PeeringContracts
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
     * @return \IvozProvider\Model\Raw\PeeringContracts
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
     * @return \IvozProvider\Model\Raw\PeeringContracts
     */
    public function setTransformationRulesetGroupsTrunksId($data)
    {

        if ($this->_transformationRulesetGroupsTrunksId != $data) {
            $this->_logChange('transformationRulesetGroupsTrunksId', $this->_transformationRulesetGroupsTrunksId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_transformationRulesetGroupsTrunksId = $data;

        } else if (!is_null($data)) {
            $this->_transformationRulesetGroupsTrunksId = (int) $data;

        } else {
            $this->_transformationRulesetGroupsTrunksId = $data;
        }
        return $this;
    }

    /**
     * Gets column transformationRulesetGroupsTrunksId
     *
     * @return int
     */
    public function getTransformationRulesetGroupsTrunksId()
    {
        return $this->_transformationRulesetGroupsTrunksId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\PeeringContracts
     */
    public function setExternallyRated($data)
    {

        if ($this->_externallyRated != $data) {
            $this->_logChange('externallyRated', $this->_externallyRated, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_externallyRated = $data;

        } else if (!is_null($data)) {
            $this->_externallyRated = (int) $data;

        } else {
            $this->_externallyRated = $data;
        }
        return $this;
    }

    /**
     * Gets column externallyRated
     *
     * @return int
     */
    public function getExternallyRated()
    {
        return $this->_externallyRated;
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
     * Sets dependent relations DDIs_ibfk_8
     *
     * @param array $data An array of \IvozProvider\Model\Raw\DDIs
     * @return \IvozProvider\Model\Raw\PeeringContracts
     */
    public function setDDIs(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_DDIs === null) {

                $this->getDDIs();
            }

            $oldRelations = $this->_DDIs;

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

        $this->_DDIs = array();

        foreach ($data as $object) {
            $this->addDDIs($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations DDIs_ibfk_8
     *
     * @param \IvozProvider\Model\Raw\DDIs $data
     * @return \IvozProvider\Model\Raw\PeeringContracts
     */
    public function addDDIs(\IvozProvider\Model\Raw\DDIs $data)
    {
        $this->_DDIs[] = $data;
        $this->_setLoaded('DDIsIbfk8');
        return $this;
    }

    /**
     * Gets dependent DDIs_ibfk_8
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\DDIs
     */
    public function getDDIs($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk8';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_DDIs = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_DDIs;
    }

    /**
     * Sets dependent relations OutgoingRouting_ibfk_5
     *
     * @param array $data An array of \IvozProvider\Model\Raw\OutgoingRouting
     * @return \IvozProvider\Model\Raw\PeeringContracts
     */
    public function setOutgoingRouting(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_OutgoingRouting === null) {

                $this->getOutgoingRouting();
            }

            $oldRelations = $this->_OutgoingRouting;

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

        $this->_OutgoingRouting = array();

        foreach ($data as $object) {
            $this->addOutgoingRouting($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations OutgoingRouting_ibfk_5
     *
     * @param \IvozProvider\Model\Raw\OutgoingRouting $data
     * @return \IvozProvider\Model\Raw\PeeringContracts
     */
    public function addOutgoingRouting(\IvozProvider\Model\Raw\OutgoingRouting $data)
    {
        $this->_OutgoingRouting[] = $data;
        $this->_setLoaded('OutgoingRoutingIbfk5');
        return $this;
    }

    /**
     * Gets dependent OutgoingRouting_ibfk_5
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\OutgoingRouting
     */
    public function getOutgoingRouting($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'OutgoingRoutingIbfk5';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_OutgoingRouting = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_OutgoingRouting;
    }

    /**
     * Sets dependent relations parsedCDRs_ibfk_6
     *
     * @param array $data An array of \IvozProvider\Model\Raw\ParsedCDRs
     * @return \IvozProvider\Model\Raw\PeeringContracts
     */
    public function setParsedCDRs(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ParsedCDRs === null) {

                $this->getParsedCDRs();
            }

            $oldRelations = $this->_ParsedCDRs;

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

        $this->_ParsedCDRs = array();

        foreach ($data as $object) {
            $this->addParsedCDRs($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations parsedCDRs_ibfk_6
     *
     * @param \IvozProvider\Model\Raw\ParsedCDRs $data
     * @return \IvozProvider\Model\Raw\PeeringContracts
     */
    public function addParsedCDRs(\IvozProvider\Model\Raw\ParsedCDRs $data)
    {
        $this->_ParsedCDRs[] = $data;
        $this->_setLoaded('ParsedCDRsIbfk6');
        return $this;
    }

    /**
     * Gets dependent parsedCDRs_ibfk_6
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function getParsedCDRs($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ParsedCDRsIbfk6';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ParsedCDRs = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ParsedCDRs;
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