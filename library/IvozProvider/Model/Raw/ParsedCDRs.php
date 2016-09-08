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
            'ParsedCDRsIbfk1'=> array(
                    'property' => 'Brand',
                    'table_name' => 'Brands',
                ),
            'ParsedCDRsIbfk2'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
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
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setStatId($data)
    {

        if ($this->_statId != $data) {
            $this->_logChange('statId', $this->_statId, $data);
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
            $this->_logChange('xstatId', $this->_xstatId, $data);
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
            $this->_logChange('statType', $this->_statType, $data);
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
            $this->_logChange('initialLeg', $this->_initialLeg, $data);
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
            $this->_logChange('initialLegHash', $this->_initialLegHash, $data);
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
            $this->_logChange('cid', $this->_cid, $data);
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
            $this->_logChange('cidHash', $this->_cidHash, $data);
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
            $this->_logChange('xcid', $this->_xcid, $data);
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
            $this->_logChange('xcidHash', $this->_xcidHash, $data);
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
            $this->_logChange('proxies', $this->_proxies, $data);
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
            $this->_logChange('type', $this->_type, $data);
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
            $this->_logChange('subtype', $this->_subtype, $data);
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
            $this->_logChange('calldate', $this->_calldate, $data);
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
            $this->_logChange('duration', $this->_duration, $data);
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setAParty($data)
    {

        if ($this->_aParty != $data) {
            $this->_logChange('aParty', $this->_aParty, $data);
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
            $this->_logChange('bParty', $this->_bParty, $data);
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
     * @return \IvozProvider\Model\Raw\ParsedCDRs
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
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setXCaller($data)
    {

        if ($this->_xCaller != $data) {
            $this->_logChange('xCaller', $this->_xCaller, $data);
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
            $this->_logChange('xCallee', $this->_xCallee, $data);
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
            $this->_logChange('initialReferrer', $this->_initialReferrer, $data);
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
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
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setLastForwarder($data)
    {

        if ($this->_lastForwarder != $data) {
            $this->_logChange('lastForwarder', $this->_lastForwarder, $data);
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\ParsedCDRs
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
     * @return \IvozProvider\Model\Raw\ParsedCDRs
     */
    public function setPeeringContractId($data)
    {

        if ($this->_peeringContractId != $data) {
            $this->_logChange('peeringContractId', $this->_peeringContractId, $data);
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