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
class ParsedCDRs extends ModelAbstract
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
    protected $_statId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_xstatId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_statType;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_initialLeg;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_initialLegHash;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_cid;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_cidHash;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_xcid;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_xcidHash;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_proxies;

    /**
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
    protected $_subtype;

    /**
     * Database var type timestamp
     *
     * @var string
     */
    protected $_calldate;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_duration;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_xDuration;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_aParty;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_bParty;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_caller;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_callee;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_xCaller;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_xCallee;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_initialReferrer;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_referrer;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_referee;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_lastForwarder;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_brandId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_companyId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_peeringContractId;

    /**
     * Billable leg CallID
     * Database var type varchar
     *
     * @var string
     */
    protected $_billCallID;

    /**
     * Billable leg duration
     * Database var type int
     *
     * @var int
     */
    protected $_billDuration;

    /**
     * Billable leg destination
     * Database var type varchar
     *
     * @var string
     */
    protected $_billDestination;

    /**
     * 1 for billable calls billed elsewhere
     * Database var type tinyint
     *
     * @var int
     */
    protected $_externallyRated;

    /**
     * 1 for billable calls with price set
     * Database var type tinyint
     *
     * @var int
     */
    protected $_metered;

    /**
     * Database var type datetime
     *
     * @var string
     */
    protected $_meteringDate;

    /**
     * Pricing plan used for setting price
     * Database var type int
     *
     * @var int
     */
    protected $_pricingPlanId;

    /**
     * Destination group for billable call
     * Database var type int
     *
     * @var int
     */
    protected $_targetPatternId;

    /**
     * Final price for billable call
     * Database var type decimal
     *
     * @var float
     */
    protected $_price;

    /**
     * Database var type text
     *
     * @var text
     */
    protected $_pricingPlanDetails;

    /**
     * Invoice for billable billed call
     * Database var type int
     *
     * @var int
     */
    protected $_invoiceId;


    /**
     * Parent relation parsedCDRs_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Brands
     */
    protected $_Brand;

    /**
     * Parent relation parsedCDRs_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;

    /**
     * Parent relation parsedCDRs_ibfk_3
     *
     * @var \IvozProvider\Model\Raw\PricingPlans
     */
    protected $_PricingPlan;

    /**
     * Parent relation parsedCDRs_ibfk_4
     *
     * @var \IvozProvider\Model\Raw\TargetPatterns
     */
    protected $_TargetPattern;

    /**
     * Parent relation parsedCDRs_ibfk_5
     *
     * @var \IvozProvider\Model\Raw\Invoices
     */
    protected $_Invoice;

    /**
     * Parent relation parsedCDRs_ibfk_6
     *
     * @var \IvozProvider\Model\Raw\PeeringContracts
     */
    protected $_PeeringContract;


    protected $_columnsList = array(
        'id'=>'id',
        'statId'=>'statId',
        'xstatId'=>'xstatId',
        'statType'=>'statType',
        'initialLeg'=>'initialLeg',
        'initialLegHash'=>'initialLegHash',
        'cid'=>'cid',
        'cidHash'=>'cidHash',
        'xcid'=>'xcid',
        'xcidHash'=>'xcidHash',
        'proxies'=>'proxies',
        'type'=>'type',
        'subtype'=>'subtype',
        'calldate'=>'calldate',
        'duration'=>'duration',
        'xDuration'=>'xDuration',
        'aParty'=>'aParty',
        'bParty'=>'bParty',
        'caller'=>'caller',
        'callee'=>'callee',
        'xCaller'=>'xCaller',
        'xCallee'=>'xCallee',
        'initialReferrer'=>'initialReferrer',
        'referrer'=>'referrer',
        'referee'=>'referee',
        'lastForwarder'=>'lastForwarder',
        'brandId'=>'brandId',
        'companyId'=>'companyId',
        'peeringContractId'=>'peeringContractId',
        'billCallID'=>'billCallID',
        'billDuration'=>'billDuration',
        'billDestination'=>'billDestination',
        'externallyRated'=>'externallyRated',
        'metered'=>'metered',
        'meteringDate'=>'meteringDate',
        'pricingPlanId'=>'pricingPlanId',
        'targetPatternId'=>'targetPatternId',
        'price'=>'price',
        'pricingPlanDetails'=>'pricingPlanDetails',
        'invoiceId'=>'invoiceId',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'billCallID'=> array(''),
            'billDuration'=> array(''),
            'billDestination'=> array(''),
            'externallyRated'=> array(''),
            'metered'=> array(''),
            'pricingPlanId'=> array(''),
            'targetPatternId'=> array(''),
            'price'=> array(''),
            'invoiceId'=> array(''),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'ParsedCDRsIbfk1'=> array(
                    'property' => 'Brand',
                    'table_name' => 'Brands',
                ),
            'ParsedCDRsIbfk2'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
            'ParsedCDRsIbfk3'=> array(
                    'property' => 'PricingPlan',
                    'table_name' => 'PricingPlans',
                ),
            'ParsedCDRsIbfk4'=> array(
                    'property' => 'TargetPattern',
                    'table_name' => 'TargetPatterns',
                ),
            'ParsedCDRsIbfk5'=> array(
                    'property' => 'Invoice',
                    'table_name' => 'Invoices',
                ),
            'ParsedCDRsIbfk6'=> array(
                    'property' => 'PeeringContract',
                    'table_name' => 'PeeringContracts',
                ),
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
            'calldate' => 'CURRENT_TIMESTAMP',
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
     * @return \IvozProvider\Model\Raw\ParsedCDRs
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
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setStatId($data)
    {

        if ($this->_statId != $data) {
            $this->_logChange('statId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_statId = $data;

        } else if (!is_null($data)) {
            $this->_statId = (int) $data;

        } else {
            $this->_statId = $data;
        }
        return $this;
    }

    /**
     * Gets column statId
     *
     * @return int
     */
    public function getStatId()
    {
        return $this->_statId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setXstatId($data)
    {

        if ($this->_xstatId != $data) {
            $this->_logChange('xstatId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_xstatId = $data;

        } else if (!is_null($data)) {
            $this->_xstatId = (int) $data;

        } else {
            $this->_xstatId = $data;
        }
        return $this;
    }

    /**
     * Gets column xstatId
     *
     * @return int
     */
    public function getXstatId()
    {
        return $this->_xstatId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setStatType($data)
    {

        if ($this->_statType != $data) {
            $this->_logChange('statType');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_statType = $data;

        } else if (!is_null($data)) {
            $this->_statType = (string) $data;

        } else {
            $this->_statType = $data;
        }
        return $this;
    }

    /**
     * Gets column statType
     *
     * @return string
     */
    public function getStatType()
    {
        return $this->_statType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setInitialLeg($data)
    {

        if ($this->_initialLeg != $data) {
            $this->_logChange('initialLeg');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_initialLeg = $data;

        } else if (!is_null($data)) {
            $this->_initialLeg = (string) $data;

        } else {
            $this->_initialLeg = $data;
        }
        return $this;
    }

    /**
     * Gets column initialLeg
     *
     * @return string
     */
    public function getInitialLeg()
    {
        return $this->_initialLeg;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setInitialLegHash($data)
    {

        if ($this->_initialLegHash != $data) {
            $this->_logChange('initialLegHash');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_initialLegHash = $data;

        } else if (!is_null($data)) {
            $this->_initialLegHash = (string) $data;

        } else {
            $this->_initialLegHash = $data;
        }
        return $this;
    }

    /**
     * Gets column initialLegHash
     *
     * @return string
     */
    public function getInitialLegHash()
    {
        return $this->_initialLegHash;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setCid($data)
    {

        if ($this->_cid != $data) {
            $this->_logChange('cid');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_cid = $data;

        } else if (!is_null($data)) {
            $this->_cid = (string) $data;

        } else {
            $this->_cid = $data;
        }
        return $this;
    }

    /**
     * Gets column cid
     *
     * @return string
     */
    public function getCid()
    {
        return $this->_cid;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setCidHash($data)
    {

        if ($this->_cidHash != $data) {
            $this->_logChange('cidHash');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_cidHash = $data;

        } else if (!is_null($data)) {
            $this->_cidHash = (string) $data;

        } else {
            $this->_cidHash = $data;
        }
        return $this;
    }

    /**
     * Gets column cidHash
     *
     * @return string
     */
    public function getCidHash()
    {
        return $this->_cidHash;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setXcid($data)
    {

        if ($this->_xcid != $data) {
            $this->_logChange('xcid');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_xcid = $data;

        } else if (!is_null($data)) {
            $this->_xcid = (string) $data;

        } else {
            $this->_xcid = $data;
        }
        return $this;
    }

    /**
     * Gets column xcid
     *
     * @return string
     */
    public function getXcid()
    {
        return $this->_xcid;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setXcidHash($data)
    {

        if ($this->_xcidHash != $data) {
            $this->_logChange('xcidHash');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_xcidHash = $data;

        } else if (!is_null($data)) {
            $this->_xcidHash = (string) $data;

        } else {
            $this->_xcidHash = $data;
        }
        return $this;
    }

    /**
     * Gets column xcidHash
     *
     * @return string
     */
    public function getXcidHash()
    {
        return $this->_xcidHash;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setProxies($data)
    {

        if ($this->_proxies != $data) {
            $this->_logChange('proxies');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_proxies = $data;

        } else if (!is_null($data)) {
            $this->_proxies = (string) $data;

        } else {
            $this->_proxies = $data;
        }
        return $this;
    }

    /**
     * Gets column proxies
     *
     * @return string
     */
    public function getProxies()
    {
        return $this->_proxies;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setType($data)
    {

        if ($this->_type != $data) {
            $this->_logChange('type');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_type = $data;

        } else if (!is_null($data)) {
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
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setSubtype($data)
    {

        if ($this->_subtype != $data) {
            $this->_logChange('subtype');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_subtype = $data;

        } else if (!is_null($data)) {
            $this->_subtype = (string) $data;

        } else {
            $this->_subtype = $data;
        }
        return $this;
    }

    /**
     * Gets column subtype
     *
     * @return string
     */
    public function getSubtype()
    {
        return $this->_subtype;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setCalldate($data)
    {
        if ($data == '0000-00-00 00:00:00') {
            $data = null;
        }
        if ($data === 'CURRENT_TIMESTAMP' || is_null($data)) {
            $data = \Zend_Date::now()->setTimezone('UTC');
        }

        if ($data instanceof \Zend_Date) {

            $data = new \DateTime($data->toString('yyyy-MM-dd HH:mm:ss'), new \DateTimeZone($data->getTimezone()));

        } elseif (!is_null($data) && !$data instanceof \DateTime) {

            $data = new \DateTime($data, new \DateTimeZone('UTC'));
        }
        if ($data instanceof \DateTime && $data->getTimezone()->getName() != 'UTC') {

            $data->setTimezone(new \DateTimeZone('UTC'));
        }

        if ($this->_calldate != $data) {
            $this->_logChange('calldate');
        }

        $this->_calldate = $data;
        return $this;
    }

    /**
     * Gets column calldate
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getCalldate($returnZendDate = false)
    {
        if (is_null($this->_calldate)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_calldate->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_calldate->format('Y-m-d H:i:s');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setDuration($data)
    {

        if ($this->_duration != $data) {
            $this->_logChange('duration');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_duration = $data;

        } else if (!is_null($data)) {
            $this->_duration = (int) $data;

        } else {
            $this->_duration = $data;
        }
        return $this;
    }

    /**
     * Gets column duration
     *
     * @return int
     */
    public function getDuration()
    {
        return $this->_duration;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setXDuration($data)
    {

        if ($this->_xDuration != $data) {
            $this->_logChange('xDuration');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_xDuration = $data;

        } else if (!is_null($data)) {
            $this->_xDuration = (int) $data;

        } else {
            $this->_xDuration = $data;
        }
        return $this;
    }

    /**
     * Gets column xDuration
     *
     * @return int
     */
    public function getXDuration()
    {
        return $this->_xDuration;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setAParty($data)
    {

        if ($this->_aParty != $data) {
            $this->_logChange('aParty');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_aParty = $data;

        } else if (!is_null($data)) {
            $this->_aParty = (string) $data;

        } else {
            $this->_aParty = $data;
        }
        return $this;
    }

    /**
     * Gets column aParty
     *
     * @return string
     */
    public function getAParty()
    {
        return $this->_aParty;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setBParty($data)
    {

        if ($this->_bParty != $data) {
            $this->_logChange('bParty');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_bParty = $data;

        } else if (!is_null($data)) {
            $this->_bParty = (string) $data;

        } else {
            $this->_bParty = $data;
        }
        return $this;
    }

    /**
     * Gets column bParty
     *
     * @return string
     */
    public function getBParty()
    {
        return $this->_bParty;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setCaller($data)
    {

        if ($this->_caller != $data) {
            $this->_logChange('caller');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_caller = $data;

        } else if (!is_null($data)) {
            $this->_caller = (string) $data;

        } else {
            $this->_caller = $data;
        }
        return $this;
    }

    /**
     * Gets column caller
     *
     * @return string
     */
    public function getCaller()
    {
        return $this->_caller;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setCallee($data)
    {

        if ($this->_callee != $data) {
            $this->_logChange('callee');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_callee = $data;

        } else if (!is_null($data)) {
            $this->_callee = (string) $data;

        } else {
            $this->_callee = $data;
        }
        return $this;
    }

    /**
     * Gets column callee
     *
     * @return string
     */
    public function getCallee()
    {
        return $this->_callee;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setXCaller($data)
    {

        if ($this->_xCaller != $data) {
            $this->_logChange('xCaller');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_xCaller = $data;

        } else if (!is_null($data)) {
            $this->_xCaller = (string) $data;

        } else {
            $this->_xCaller = $data;
        }
        return $this;
    }

    /**
     * Gets column xCaller
     *
     * @return string
     */
    public function getXCaller()
    {
        return $this->_xCaller;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setXCallee($data)
    {

        if ($this->_xCallee != $data) {
            $this->_logChange('xCallee');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_xCallee = $data;

        } else if (!is_null($data)) {
            $this->_xCallee = (string) $data;

        } else {
            $this->_xCallee = $data;
        }
        return $this;
    }

    /**
     * Gets column xCallee
     *
     * @return string
     */
    public function getXCallee()
    {
        return $this->_xCallee;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setInitialReferrer($data)
    {

        if ($this->_initialReferrer != $data) {
            $this->_logChange('initialReferrer');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_initialReferrer = $data;

        } else if (!is_null($data)) {
            $this->_initialReferrer = (string) $data;

        } else {
            $this->_initialReferrer = $data;
        }
        return $this;
    }

    /**
     * Gets column initialReferrer
     *
     * @return string
     */
    public function getInitialReferrer()
    {
        return $this->_initialReferrer;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setReferrer($data)
    {

        if ($this->_referrer != $data) {
            $this->_logChange('referrer');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_referrer = $data;

        } else if (!is_null($data)) {
            $this->_referrer = (string) $data;

        } else {
            $this->_referrer = $data;
        }
        return $this;
    }

    /**
     * Gets column referrer
     *
     * @return string
     */
    public function getReferrer()
    {
        return $this->_referrer;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setReferee($data)
    {

        if ($this->_referee != $data) {
            $this->_logChange('referee');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_referee = $data;

        } else if (!is_null($data)) {
            $this->_referee = (string) $data;

        } else {
            $this->_referee = $data;
        }
        return $this;
    }

    /**
     * Gets column referee
     *
     * @return string
     */
    public function getReferee()
    {
        return $this->_referee;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setLastForwarder($data)
    {

        if ($this->_lastForwarder != $data) {
            $this->_logChange('lastForwarder');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_lastForwarder = $data;

        } else if (!is_null($data)) {
            $this->_lastForwarder = (string) $data;

        } else {
            $this->_lastForwarder = $data;
        }
        return $this;
    }

    /**
     * Gets column lastForwarder
     *
     * @return string
     */
    public function getLastForwarder()
    {
        return $this->_lastForwarder;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setBrandId($data)
    {

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
     * @param int $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setCompanyId($data)
    {

        if ($this->_companyId != $data) {
            $this->_logChange('companyId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_companyId = $data;

        } else if (!is_null($data)) {
            $this->_companyId = (int) $data;

        } else {
            $this->_companyId = $data;
        }
        return $this;
    }

    /**
     * Gets column companyId
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->_companyId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setPeeringContractId($data)
    {

        if ($this->_peeringContractId != $data) {
            $this->_logChange('peeringContractId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_peeringContractId = $data;

        } else if (!is_null($data)) {
            $this->_peeringContractId = (int) $data;

        } else {
            $this->_peeringContractId = $data;
        }
        return $this;
    }

    /**
     * Gets column peeringContractId
     *
     * @return int
     */
    public function getPeeringContractId()
    {
        return $this->_peeringContractId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setBillCallID($data)
    {

        if ($this->_billCallID != $data) {
            $this->_logChange('billCallID');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_billCallID = $data;

        } else if (!is_null($data)) {
            $this->_billCallID = (string) $data;

        } else {
            $this->_billCallID = $data;
        }
        return $this;
    }

    /**
     * Gets column billCallID
     *
     * @return string
     */
    public function getBillCallID()
    {
        return $this->_billCallID;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setBillDuration($data)
    {

        if ($this->_billDuration != $data) {
            $this->_logChange('billDuration');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_billDuration = $data;

        } else if (!is_null($data)) {
            $this->_billDuration = (int) $data;

        } else {
            $this->_billDuration = $data;
        }
        return $this;
    }

    /**
     * Gets column billDuration
     *
     * @return int
     */
    public function getBillDuration()
    {
        return $this->_billDuration;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setBillDestination($data)
    {

        if ($this->_billDestination != $data) {
            $this->_logChange('billDestination');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_billDestination = $data;

        } else if (!is_null($data)) {
            $this->_billDestination = (string) $data;

        } else {
            $this->_billDestination = $data;
        }
        return $this;
    }

    /**
     * Gets column billDestination
     *
     * @return string
     */
    public function getBillDestination()
    {
        return $this->_billDestination;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setExternallyRated($data)
    {

        if ($this->_externallyRated != $data) {
            $this->_logChange('externallyRated');
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
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setMetered($data)
    {

        if ($this->_metered != $data) {
            $this->_logChange('metered');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_metered = $data;

        } else if (!is_null($data)) {
            $this->_metered = (int) $data;

        } else {
            $this->_metered = $data;
        }
        return $this;
    }

    /**
     * Gets column metered
     *
     * @return int
     */
    public function getMetered()
    {
        return $this->_metered;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setMeteringDate($data)
    {
        if ($data == '0000-00-00 00:00:00') {
            $data = null;
        }
        if ($data === 'CURRENT_TIMESTAMP') {
            $data = \Zend_Date::now()->setTimezone('UTC');
        }

        if ($data instanceof \Zend_Date) {

            $data = new \DateTime($data->toString('yyyy-MM-dd HH:mm:ss'), new \DateTimeZone($data->getTimezone()));

        } elseif (!is_null($data) && !$data instanceof \DateTime) {

            $data = new \DateTime($data, new \DateTimeZone('UTC'));
        }
        if ($data instanceof \DateTime && $data->getTimezone()->getName() != 'UTC') {

            $data->setTimezone(new \DateTimeZone('UTC'));
        }

        if ($this->_meteringDate != $data) {
            $this->_logChange('meteringDate');
        }

        $this->_meteringDate = $data;
        return $this;
    }

    /**
     * Gets column meteringDate
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getMeteringDate($returnZendDate = false)
    {
        if (is_null($this->_meteringDate)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_meteringDate->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_meteringDate->format('Y-m-d H:i:s');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setPricingPlanId($data)
    {

        if ($this->_pricingPlanId != $data) {
            $this->_logChange('pricingPlanId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_pricingPlanId = $data;

        } else if (!is_null($data)) {
            $this->_pricingPlanId = (int) $data;

        } else {
            $this->_pricingPlanId = $data;
        }
        return $this;
    }

    /**
     * Gets column pricingPlanId
     *
     * @return int
     */
    public function getPricingPlanId()
    {
        return $this->_pricingPlanId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setTargetPatternId($data)
    {

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
     * @param float $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setPrice($data)
    {

        if ($this->_price != $data) {
            $this->_logChange('price');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_price = $data;

        } else if (!is_null($data)) {
            $this->_price = (float) $data;

        } else {
            $this->_price = $data;
        }
        return $this;
    }

    /**
     * Gets column price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param text $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setPricingPlanDetails($data)
    {

        if ($this->_pricingPlanDetails != $data) {
            $this->_logChange('pricingPlanDetails');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_pricingPlanDetails = $data;

        } else if (!is_null($data)) {
            $this->_pricingPlanDetails = (string) $data;

        } else {
            $this->_pricingPlanDetails = $data;
        }
        return $this;
    }

    /**
     * Gets column pricingPlanDetails
     *
     * @return text
     */
    public function getPricingPlanDetails()
    {
        return $this->_pricingPlanDetails;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setInvoiceId($data)
    {

        if ($this->_invoiceId != $data) {
            $this->_logChange('invoiceId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_invoiceId = $data;

        } else if (!is_null($data)) {
            $this->_invoiceId = (int) $data;

        } else {
            $this->_invoiceId = $data;
        }
        return $this;
    }

    /**
     * Gets column invoiceId
     *
     * @return int
     */
    public function getInvoiceId()
    {
        return $this->_invoiceId;
    }

    /**
     * Sets parent relation Brand
     *
     * @param \IvozProvider\Model\Raw\Brands $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
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

        $this->_setLoaded('ParsedCDRsIbfk1');
        return $this;
    }

    /**
     * Gets parent Brand
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function getBrand($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ParsedCDRsIbfk1';

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
     * Sets parent relation Company
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setCompany(\IvozProvider\Model\Raw\Companies $data)
    {
        $this->_Company = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setCompanyId($primaryKey);
        }

        $this->_setLoaded('ParsedCDRsIbfk2');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ParsedCDRsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Company = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Company;
    }

    /**
     * Sets parent relation PricingPlan
     *
     * @param \IvozProvider\Model\Raw\PricingPlans $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setPricingPlan(\IvozProvider\Model\Raw\PricingPlans $data)
    {
        $this->_PricingPlan = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setPricingPlanId($primaryKey);
        }

        $this->_setLoaded('ParsedCDRsIbfk3');
        return $this;
    }

    /**
     * Gets parent PricingPlan
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\PricingPlans
     */
    public function getPricingPlan($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ParsedCDRsIbfk3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_PricingPlan = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_PricingPlan;
    }

    /**
     * Sets parent relation TargetPattern
     *
     * @param \IvozProvider\Model\Raw\TargetPatterns $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
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

        $this->_setLoaded('ParsedCDRsIbfk4');
        return $this;
    }

    /**
     * Gets parent TargetPattern
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\TargetPatterns
     */
    public function getTargetPattern($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ParsedCDRsIbfk4';

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
     * Sets parent relation Invoice
     *
     * @param \IvozProvider\Model\Raw\Invoices $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setInvoice(\IvozProvider\Model\Raw\Invoices $data)
    {
        $this->_Invoice = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setInvoiceId($primaryKey);
        }

        $this->_setLoaded('ParsedCDRsIbfk5');
        return $this;
    }

    /**
     * Gets parent Invoice
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Invoices
     */
    public function getInvoice($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ParsedCDRsIbfk5';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Invoice = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Invoice;
    }

    /**
     * Sets parent relation PeeringContract
     *
     * @param \IvozProvider\Model\Raw\PeeringContracts $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setPeeringContract(\IvozProvider\Model\Raw\PeeringContracts $data)
    {
        $this->_PeeringContract = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setPeeringContractId($primaryKey);
        }

        $this->_setLoaded('ParsedCDRsIbfk6');
        return $this;
    }

    /**
     * Gets parent PeeringContract
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\PeeringContracts
     */
    public function getPeeringContract($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ParsedCDRsIbfk6';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_PeeringContract = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_PeeringContract;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\ParsedCDRs
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\ParsedCDRs')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\ParsedCDRs);

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
     * @return null | \IvozProvider\Model\Validator\ParsedCDRs
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\ParsedCDRs')) {

                $this->setValidator(new \IvozProvider\Validator\ParsedCDRs);
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
     * @see \Mapper\Sql\ParsedCDRs::delete
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