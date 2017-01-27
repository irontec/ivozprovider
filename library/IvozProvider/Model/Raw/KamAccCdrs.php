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
class KamAccCdrs extends ModelAbstract
{

    protected $_parsedAcceptedValues = array(
        'yes',
        'no',
        'error',
    );
    protected $_bouncedAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_directionAcceptedValues = array(
        'inbound',
        'outbound',
    );

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
    protected $_proxy;

    /**
     * Database var type timestamp
     *
     * @var string
     */
    protected $_startTimeUtc;

    /**
     * Database var type timestamp
     *
     * @var string
     */
    protected $_endTimeUtc;

    /**
     * Database var type datetime
     *
     * @var string
     */
    protected $_startTime;

    /**
     * Database var type datetime
     *
     * @var string
     */
    protected $_endTime;

    /**
     * Database var type float
     *
     * @var float
     */
    protected $_duration;

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
    protected $_referee;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_referrer;

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
     * Database var type varchar
     *
     * @var string
     */
    protected $_asIden;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_asAddress;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_callid;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_callidHash;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_xcallid;

    /**
     * Database var type enum('yes','no','error')
     *
     * @var string
     */
    protected $_parsed;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_diversion;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_peeringContractId;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_bounced;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_externallyRated;

    /**
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
     * Database var type int
     *
     * @var int
     */
    protected $_pricingPlanId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_pricingPlanName;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_targetPatternId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_targetPatternName;

    /**
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
     * Database var type int
     *
     * @var int
     */
    protected $_invoiceId;

    /**
     * Database var type enum('inbound','outbound')
     *
     * @var string
     */
    protected $_direction;

    /**
     * Database var type datetime
     *
     * @var string
     */
    protected $_reMeteringDate;


    /**
     * Parent relation kam_acc_cdrs_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\PricingPlans
     */
    protected $_PricingPlan;

    /**
     * Parent relation kam_acc_cdrs_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\TargetPatterns
     */
    protected $_TargetPattern;

    /**
     * Parent relation kam_acc_cdrs_ibfk_3
     *
     * @var \IvozProvider\Model\Raw\Invoices
     */
    protected $_Invoice;

    /**
     * Parent relation kam_acc_cdrs_ibfk_5
     *
     * @var \IvozProvider\Model\Raw\Brands
     */
    protected $_Brand;

    /**
     * Parent relation kam_acc_cdrs_ibfk_6
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;


    protected $_columnsList = array(
        'id'=>'id',
        'proxy'=>'proxy',
        'start_time_utc'=>'startTimeUtc',
        'end_time_utc'=>'endTimeUtc',
        'start_time'=>'startTime',
        'end_time'=>'endTime',
        'duration'=>'duration',
        'caller'=>'caller',
        'callee'=>'callee',
        'referee'=>'referee',
        'referrer'=>'referrer',
        'companyId'=>'companyId',
        'brandId'=>'brandId',
        'asIden'=>'asIden',
        'asAddress'=>'asAddress',
        'callid'=>'callid',
        'callidHash'=>'callidHash',
        'xcallid'=>'xcallid',
        'parsed'=>'parsed',
        'diversion'=>'diversion',
        'peeringContractId'=>'peeringContractId',
        'bounced'=>'bounced',
        'externallyRated'=>'externallyRated',
        'metered'=>'metered',
        'meteringDate'=>'meteringDate',
        'pricingPlanId'=>'pricingPlanId',
        'pricingPlanName'=>'pricingPlanName',
        'targetPatternId'=>'targetPatternId',
        'targetPatternName'=>'targetPatternName',
        'price'=>'price',
        'pricingPlanDetails'=>'pricingPlanDetails',
        'invoiceId'=>'invoiceId',
        'direction'=>'direction',
        'reMeteringDate'=>'reMeteringDate',
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
            'KamAccCdrsIbfk1'=> array(
                    'property' => 'PricingPlan',
                    'table_name' => 'PricingPlans',
                ),
            'KamAccCdrsIbfk2'=> array(
                    'property' => 'TargetPattern',
                    'table_name' => 'TargetPatterns',
                ),
            'KamAccCdrsIbfk3'=> array(
                    'property' => 'Invoice',
                    'table_name' => 'Invoices',
                ),
            'KamAccCdrsIbfk5'=> array(
                    'property' => 'Brand',
                    'table_name' => 'Brands',
                ),
            'KamAccCdrsIbfk6'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
            'startTimeUtc' => '2000-01-01 00:00:00',
            'endTimeUtc' => 'CURRENT_TIMESTAMP',
            'startTime' => '2000-01-01 00:00:00',
            'endTime' => '2000-01-01 00:00:00',
            'duration' => '0.000',
            'bounced' => 'no',
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
     * @return \IvozProvider\Model\Raw\KamAccCdrs
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
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setProxy($data)
    {

        if ($this->_proxy != $data) {
            $this->_logChange('proxy', $this->_proxy, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_proxy = $data;

        } else if (!is_null($data)) {
            $this->_proxy = (string) $data;

        } else {
            $this->_proxy = $data;
        }
        return $this;
    }

    /**
     * Gets column proxy
     *
     * @return string
     */
    public function getProxy()
    {
        return $this->_proxy;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setStartTimeUtc($data)
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

        if ($this->_startTimeUtc != $data) {
            $this->_logChange('startTimeUtc', $this->_startTimeUtc, $data);
        }

        $this->_startTimeUtc = $data;
        return $this;
    }

    /**
     * Gets column start_time_utc
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getStartTimeUtc($returnZendDate = false)
    {
        if (is_null($this->_startTimeUtc)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_startTimeUtc->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_startTimeUtc->format('Y-m-d H:i:s');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setEndTimeUtc($data)
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

        if ($this->_endTimeUtc != $data) {
            $this->_logChange('endTimeUtc', $this->_endTimeUtc, $data);
        }

        $this->_endTimeUtc = $data;
        return $this;
    }

    /**
     * Gets column end_time_utc
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getEndTimeUtc($returnZendDate = false)
    {
        if (is_null($this->_endTimeUtc)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_endTimeUtc->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_endTimeUtc->format('Y-m-d H:i:s');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setStartTime($data)
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

        if ($this->_startTime != $data) {
            $this->_logChange('startTime', $this->_startTime, $data);
        }

        $this->_startTime = $data;
        return $this;
    }

    /**
     * Gets column start_time
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getStartTime($returnZendDate = false)
    {
        if (is_null($this->_startTime)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_startTime->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_startTime->format('Y-m-d H:i:s');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setEndTime($data)
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

        if ($this->_endTime != $data) {
            $this->_logChange('endTime', $this->_endTime, $data);
        }

        $this->_endTime = $data;
        return $this;
    }

    /**
     * Gets column end_time
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getEndTime($returnZendDate = false)
    {
        if (is_null($this->_endTime)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_endTime->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_endTime->format('Y-m-d H:i:s');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param float $data
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setDuration($data)
    {

        if ($this->_duration != $data) {
            $this->_logChange('duration', $this->_duration, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_duration = $data;

        } else if (!is_null($data)) {
            $this->_duration = (float) $data;

        } else {
            $this->_duration = $data;
        }
        return $this;
    }

    /**
     * Gets column duration
     *
     * @return float
     */
    public function getDuration()
    {
        return $this->_duration;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setCaller($data)
    {

        if ($this->_caller != $data) {
            $this->_logChange('caller', $this->_caller, $data);
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
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setCallee($data)
    {

        if ($this->_callee != $data) {
            $this->_logChange('callee', $this->_callee, $data);
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
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setReferee($data)
    {

        if ($this->_referee != $data) {
            $this->_logChange('referee', $this->_referee, $data);
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
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setReferrer($data)
    {

        if ($this->_referrer != $data) {
            $this->_logChange('referrer', $this->_referrer, $data);
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setCompanyId($data)
    {

        if ($this->_companyId != $data) {
            $this->_logChange('companyId', $this->_companyId, $data);
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
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setBrandId($data)
    {

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
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setAsIden($data)
    {

        if ($this->_asIden != $data) {
            $this->_logChange('asIden', $this->_asIden, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_asIden = $data;

        } else if (!is_null($data)) {
            $this->_asIden = (string) $data;

        } else {
            $this->_asIden = $data;
        }
        return $this;
    }

    /**
     * Gets column asIden
     *
     * @return string
     */
    public function getAsIden()
    {
        return $this->_asIden;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setAsAddress($data)
    {

        if ($this->_asAddress != $data) {
            $this->_logChange('asAddress', $this->_asAddress, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_asAddress = $data;

        } else if (!is_null($data)) {
            $this->_asAddress = (string) $data;

        } else {
            $this->_asAddress = $data;
        }
        return $this;
    }

    /**
     * Gets column asAddress
     *
     * @return string
     */
    public function getAsAddress()
    {
        return $this->_asAddress;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setCallid($data)
    {

        if ($this->_callid != $data) {
            $this->_logChange('callid', $this->_callid, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_callid = $data;

        } else if (!is_null($data)) {
            $this->_callid = (string) $data;

        } else {
            $this->_callid = $data;
        }
        return $this;
    }

    /**
     * Gets column callid
     *
     * @return string
     */
    public function getCallid()
    {
        return $this->_callid;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setCallidHash($data)
    {

        if ($this->_callidHash != $data) {
            $this->_logChange('callidHash', $this->_callidHash, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_callidHash = $data;

        } else if (!is_null($data)) {
            $this->_callidHash = (string) $data;

        } else {
            $this->_callidHash = $data;
        }
        return $this;
    }

    /**
     * Gets column callidHash
     *
     * @return string
     */
    public function getCallidHash()
    {
        return $this->_callidHash;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setXcallid($data)
    {

        if ($this->_xcallid != $data) {
            $this->_logChange('xcallid', $this->_xcallid, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_xcallid = $data;

        } else if (!is_null($data)) {
            $this->_xcallid = (string) $data;

        } else {
            $this->_xcallid = $data;
        }
        return $this;
    }

    /**
     * Gets column xcallid
     *
     * @return string
     */
    public function getXcallid()
    {
        return $this->_xcallid;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setParsed($data)
    {

        if ($this->_parsed != $data) {
            $this->_logChange('parsed', $this->_parsed, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_parsed = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_parsedAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for parsed'));
            }
            $this->_parsed = (string) $data;

        } else {
            $this->_parsed = $data;
        }
        return $this;
    }

    /**
     * Gets column parsed
     *
     * @return string
     */
    public function getParsed()
    {
        return $this->_parsed;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setDiversion($data)
    {

        if ($this->_diversion != $data) {
            $this->_logChange('diversion', $this->_diversion, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_diversion = $data;

        } else if (!is_null($data)) {
            $this->_diversion = (string) $data;

        } else {
            $this->_diversion = $data;
        }
        return $this;
    }

    /**
     * Gets column diversion
     *
     * @return string
     */
    public function getDiversion()
    {
        return $this->_diversion;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setPeeringContractId($data)
    {

        if ($this->_peeringContractId != $data) {
            $this->_logChange('peeringContractId', $this->_peeringContractId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_peeringContractId = $data;

        } else if (!is_null($data)) {
            $this->_peeringContractId = (string) $data;

        } else {
            $this->_peeringContractId = $data;
        }
        return $this;
    }

    /**
     * Gets column peeringContractId
     *
     * @return string
     */
    public function getPeeringContractId()
    {
        return $this->_peeringContractId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setBounced($data)
    {

        if ($this->_bounced != $data) {
            $this->_logChange('bounced', $this->_bounced, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_bounced = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_bouncedAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for bounced'));
            }
            $this->_bounced = (string) $data;

        } else {
            $this->_bounced = $data;
        }
        return $this;
    }

    /**
     * Gets column bounced
     *
     * @return string
     */
    public function getBounced()
    {
        return $this->_bounced;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\KamAccCdrs
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
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setMetered($data)
    {

        if ($this->_metered != $data) {
            $this->_logChange('metered', $this->_metered, $data);
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
     * @return \IvozProvider\Model\Raw\KamAccCdrs
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
            $this->_logChange('meteringDate', $this->_meteringDate, $data);
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
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setPricingPlanId($data)
    {

        if ($this->_pricingPlanId != $data) {
            $this->_logChange('pricingPlanId', $this->_pricingPlanId, $data);
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setPricingPlanName($data)
    {

        if ($this->_pricingPlanName != $data) {
            $this->_logChange('pricingPlanName', $this->_pricingPlanName, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_pricingPlanName = $data;

        } else if (!is_null($data)) {
            $this->_pricingPlanName = (string) $data;

        } else {
            $this->_pricingPlanName = $data;
        }
        return $this;
    }

    /**
     * Gets column pricingPlanName
     *
     * @return string
     */
    public function getPricingPlanName()
    {
        return $this->_pricingPlanName;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setTargetPatternId($data)
    {

        if ($this->_targetPatternId != $data) {
            $this->_logChange('targetPatternId', $this->_targetPatternId, $data);
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setTargetPatternName($data)
    {

        if ($this->_targetPatternName != $data) {
            $this->_logChange('targetPatternName', $this->_targetPatternName, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_targetPatternName = $data;

        } else if (!is_null($data)) {
            $this->_targetPatternName = (string) $data;

        } else {
            $this->_targetPatternName = $data;
        }
        return $this;
    }

    /**
     * Gets column targetPatternName
     *
     * @return string
     */
    public function getTargetPatternName()
    {
        return $this->_targetPatternName;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param float $data
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setPrice($data)
    {

        if ($this->_price != $data) {
            $this->_logChange('price', $this->_price, $data);
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
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setPricingPlanDetails($data)
    {

        if ($this->_pricingPlanDetails != $data) {
            $this->_logChange('pricingPlanDetails', $this->_pricingPlanDetails, $data);
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
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setInvoiceId($data)
    {

        if ($this->_invoiceId != $data) {
            $this->_logChange('invoiceId', $this->_invoiceId, $data);
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setDirection($data)
    {

        if ($this->_direction != $data) {
            $this->_logChange('direction', $this->_direction, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_direction = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_directionAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for direction'));
            }
            $this->_direction = (string) $data;

        } else {
            $this->_direction = $data;
        }
        return $this;
    }

    /**
     * Gets column direction
     *
     * @return string
     */
    public function getDirection()
    {
        return $this->_direction;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function setReMeteringDate($data)
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

        if ($this->_reMeteringDate != $data) {
            $this->_logChange('reMeteringDate', $this->_reMeteringDate, $data);
        }

        $this->_reMeteringDate = $data;
        return $this;
    }

    /**
     * Gets column reMeteringDate
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getReMeteringDate($returnZendDate = false)
    {
        if (is_null($this->_reMeteringDate)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_reMeteringDate->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_reMeteringDate->format('Y-m-d H:i:s');
    }

    /**
     * Sets parent relation PricingPlan
     *
     * @param \IvozProvider\Model\Raw\PricingPlans $data
     * @return \IvozProvider\Model\Raw\KamAccCdrs
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

        $this->_setLoaded('KamAccCdrsIbfk1');
        return $this;
    }

    /**
     * Gets parent PricingPlan
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\PricingPlans
     */
    public function getPricingPlan($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamAccCdrsIbfk1';

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
     * @return \IvozProvider\Model\Raw\KamAccCdrs
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

        $this->_setLoaded('KamAccCdrsIbfk2');
        return $this;
    }

    /**
     * Gets parent TargetPattern
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\TargetPatterns
     */
    public function getTargetPattern($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamAccCdrsIbfk2';

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
     * @return \IvozProvider\Model\Raw\KamAccCdrs
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

        $this->_setLoaded('KamAccCdrsIbfk3');
        return $this;
    }

    /**
     * Gets parent Invoice
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Invoices
     */
    public function getInvoice($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamAccCdrsIbfk3';

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
     * Sets parent relation Brand
     *
     * @param \IvozProvider\Model\Raw\Brands $data
     * @return \IvozProvider\Model\Raw\KamAccCdrs
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

        $this->_setLoaded('KamAccCdrsIbfk5');
        return $this;
    }

    /**
     * Gets parent Brand
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function getBrand($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamAccCdrsIbfk5';

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
     * @return \IvozProvider\Model\Raw\KamAccCdrs
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

        $this->_setLoaded('KamAccCdrsIbfk6');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamAccCdrsIbfk6';

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
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\KamAccCdrs
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\KamAccCdrs')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\KamAccCdrs);

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
     * @return null | \IvozProvider\Model\Validator\KamAccCdrs
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\KamAccCdrs')) {

                $this->setValidator(new \IvozProvider\Validator\KamAccCdrs);
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
     * @see \Mapper\Sql\KamAccCdrs::delete
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