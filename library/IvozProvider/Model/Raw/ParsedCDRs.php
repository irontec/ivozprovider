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
class ParsedCDRs extends ModelAbstract
{


    /**
     * Database var type int
     *
     * @var int
     */
    protected $_id;

    /**
     * aleg timestamp
     * Database var type timestamp
     *
     * @var string
     */
    protected $_calldate;

    /**
     * Call type
     * Database var type varchar
     *
     * @var string
     */
    protected $_type;

    /**
     * Call description
     * Database var type varchar
     *
     * @var string
     */
    protected $_desc;

    /**
     * Caller
     * Database var type varchar
     *
     * @var string
     */
    protected $_src;

    /**
     * Dialed Number
     * Database var type varchar
     *
     * @var string
     */
    protected $_srcDialed;

    /**
     * aleg call duration
     * Database var type int
     *
     * @var int
     */
    protected $_srcDuration;

    /**
     * Final Callee - bleg destination
     * Database var type varchar
     *
     * @var string
     */
    protected $_dst;

    /**
     * CallerID seen by call destination
     * Database var type varchar
     *
     * @var string
     */
    protected $_dstSrcCid;

    /**
     * bleg call duration
     * Database var type int
     *
     * @var int
     */
    protected $_dstDuration;

    /**
     * Call forwarding description
     * Database var type varchar
     *
     * @var string
     */
    protected $_fwDesc;

    /**
     * aleg diversion
     * Database var type varchar
     *
     * @var string
     */
    protected $_extForwarder;

    /**
     * bleg diversion
     * Database var type varchar
     *
     * @var string
     */
    protected $_intForwarder;

    /**
     * Dialed number after forwarding
     * Database var type varchar
     *
     * @var string
     */
    protected $_forwardTo;

    /**
     * aleg CallID
     * Database var type varchar
     *
     * @var string
     */
    protected $_aleg;

    /**
     * bleg CallID
     * Database var type varchar
     *
     * @var string
     */
    protected $_bleg;

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
     * Billable call used Peering Contract
     * Database var type int
     *
     * @var int
     */
    protected $_peeringContractId;

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
    protected $_brandId;


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
        'calldate'=>'calldate',
        'type'=>'type',
        'desc'=>'desc',
        'src'=>'src',
        'src_dialed'=>'srcDialed',
        'src_duration'=>'srcDuration',
        'dst'=>'dst',
        'dst_src_cid'=>'dstSrcCid',
        'dst_duration'=>'dstDuration',
        'fw_desc'=>'fwDesc',
        'ext_forwarder'=>'extForwarder',
        'int_forwarder'=>'intForwarder',
        'forward_to'=>'forwardTo',
        'aleg'=>'aleg',
        'bleg'=>'bleg',
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
        'peeringContractId'=>'peeringContractId',
        'companyId'=>'companyId',
        'brandId'=>'brandId',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'calldate'=> array(''),
            'type'=> array(''),
            'desc'=> array(''),
            'src'=> array(''),
            'src_dialed'=> array(''),
            'src_duration'=> array(''),
            'dst'=> array(''),
            'dst_src_cid'=> array(''),
            'dst_duration'=> array(''),
            'fw_desc'=> array(''),
            'ext_forwarder'=> array(''),
            'int_forwarder'=> array(''),
            'forward_to'=> array(''),
            'aleg'=> array(''),
            'bleg'=> array(''),
            'billCallID'=> array(''),
            'billDuration'=> array(''),
            'billDestination'=> array(''),
            'externallyRated'=> array(''),
            'metered'=> array(''),
            'pricingPlanId'=> array(''),
            'targetPatternId'=> array(''),
            'price'=> array(''),
            'invoiceId'=> array(''),
            'peeringContractId'=> array(''),
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
            'calldate' => '0000-00-00 00:00:00',
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
    public function setDesc($data)
    {

        if ($this->_desc != $data) {
            $this->_logChange('desc');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_desc = $data;

        } else if (!is_null($data)) {
            $this->_desc = (string) $data;

        } else {
            $this->_desc = $data;
        }
        return $this;
    }

    /**
     * Gets column desc
     *
     * @return string
     */
    public function getDesc()
    {
        return $this->_desc;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setSrc($data)
    {

        if ($this->_src != $data) {
            $this->_logChange('src');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_src = $data;

        } else if (!is_null($data)) {
            $this->_src = (string) $data;

        } else {
            $this->_src = $data;
        }
        return $this;
    }

    /**
     * Gets column src
     *
     * @return string
     */
    public function getSrc()
    {
        return $this->_src;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setSrcDialed($data)
    {

        if ($this->_srcDialed != $data) {
            $this->_logChange('srcDialed');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_srcDialed = $data;

        } else if (!is_null($data)) {
            $this->_srcDialed = (string) $data;

        } else {
            $this->_srcDialed = $data;
        }
        return $this;
    }

    /**
     * Gets column src_dialed
     *
     * @return string
     */
    public function getSrcDialed()
    {
        return $this->_srcDialed;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setSrcDuration($data)
    {

        if ($this->_srcDuration != $data) {
            $this->_logChange('srcDuration');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_srcDuration = $data;

        } else if (!is_null($data)) {
            $this->_srcDuration = (int) $data;

        } else {
            $this->_srcDuration = $data;
        }
        return $this;
    }

    /**
     * Gets column src_duration
     *
     * @return int
     */
    public function getSrcDuration()
    {
        return $this->_srcDuration;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setDst($data)
    {

        if ($this->_dst != $data) {
            $this->_logChange('dst');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_dst = $data;

        } else if (!is_null($data)) {
            $this->_dst = (string) $data;

        } else {
            $this->_dst = $data;
        }
        return $this;
    }

    /**
     * Gets column dst
     *
     * @return string
     */
    public function getDst()
    {
        return $this->_dst;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setDstSrcCid($data)
    {

        if ($this->_dstSrcCid != $data) {
            $this->_logChange('dstSrcCid');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_dstSrcCid = $data;

        } else if (!is_null($data)) {
            $this->_dstSrcCid = (string) $data;

        } else {
            $this->_dstSrcCid = $data;
        }
        return $this;
    }

    /**
     * Gets column dst_src_cid
     *
     * @return string
     */
    public function getDstSrcCid()
    {
        return $this->_dstSrcCid;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setDstDuration($data)
    {

        if ($this->_dstDuration != $data) {
            $this->_logChange('dstDuration');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_dstDuration = $data;

        } else if (!is_null($data)) {
            $this->_dstDuration = (int) $data;

        } else {
            $this->_dstDuration = $data;
        }
        return $this;
    }

    /**
     * Gets column dst_duration
     *
     * @return int
     */
    public function getDstDuration()
    {
        return $this->_dstDuration;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setFwDesc($data)
    {

        if ($this->_fwDesc != $data) {
            $this->_logChange('fwDesc');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_fwDesc = $data;

        } else if (!is_null($data)) {
            $this->_fwDesc = (string) $data;

        } else {
            $this->_fwDesc = $data;
        }
        return $this;
    }

    /**
     * Gets column fw_desc
     *
     * @return string
     */
    public function getFwDesc()
    {
        return $this->_fwDesc;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setExtForwarder($data)
    {

        if ($this->_extForwarder != $data) {
            $this->_logChange('extForwarder');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_extForwarder = $data;

        } else if (!is_null($data)) {
            $this->_extForwarder = (string) $data;

        } else {
            $this->_extForwarder = $data;
        }
        return $this;
    }

    /**
     * Gets column ext_forwarder
     *
     * @return string
     */
    public function getExtForwarder()
    {
        return $this->_extForwarder;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setIntForwarder($data)
    {

        if ($this->_intForwarder != $data) {
            $this->_logChange('intForwarder');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_intForwarder = $data;

        } else if (!is_null($data)) {
            $this->_intForwarder = (string) $data;

        } else {
            $this->_intForwarder = $data;
        }
        return $this;
    }

    /**
     * Gets column int_forwarder
     *
     * @return string
     */
    public function getIntForwarder()
    {
        return $this->_intForwarder;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setForwardTo($data)
    {

        if ($this->_forwardTo != $data) {
            $this->_logChange('forwardTo');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_forwardTo = $data;

        } else if (!is_null($data)) {
            $this->_forwardTo = (string) $data;

        } else {
            $this->_forwardTo = $data;
        }
        return $this;
    }

    /**
     * Gets column forward_to
     *
     * @return string
     */
    public function getForwardTo()
    {
        return $this->_forwardTo;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setAleg($data)
    {

        if ($this->_aleg != $data) {
            $this->_logChange('aleg');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_aleg = $data;

        } else if (!is_null($data)) {
            $this->_aleg = (string) $data;

        } else {
            $this->_aleg = $data;
        }
        return $this;
    }

    /**
     * Gets column aleg
     *
     * @return string
     */
    public function getAleg()
    {
        return $this->_aleg;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setBleg($data)
    {

        if ($this->_bleg != $data) {
            $this->_logChange('bleg');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_bleg = $data;

        } else if (!is_null($data)) {
            $this->_bleg = (string) $data;

        } else {
            $this->_bleg = $data;
        }
        return $this;
    }

    /**
     * Gets column bleg
     *
     * @return string
     */
    public function getBleg()
    {
        return $this->_bleg;
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