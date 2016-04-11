<?php

/**
 * Application Model
 *
 * @package Oasis\Model\Raw
 * @subpackage Model
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * 
 *
 * @package Oasis\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace Oasis\Model\Raw;
class AstQueues extends ModelAbstract
{

    protected $_ringinuseAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_setinterfacevarAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_setqueuevarAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_setqueueentryvarAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_announceToFirstUserAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_relativePeriodicAnnounceAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_randomPeriodicAnnounceAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_autofillAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_autopauseAcceptedValues = array(
        'yes',
        'no',
        'all',
    );
    protected $_autopausebusyAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_autopauseunavailAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_strategyAcceptedValues = array(
        'ringall',
        'leastrecent',
        'fewestcalls',
        'random',
        'rrmemory',
        'linear',
        'wrandom',
        'rrordered',
    );
    protected $_reportholdtimeAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_timeoutrestartAcceptedValues = array(
        'yes',
        'no',
    );

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
    protected $_astMusiconhold;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_announce;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_context;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_timeout;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_ringinuse;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_setinterfacevar;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_setqueuevar;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_setqueueentryvar;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_monitorFormat;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_membermacro;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_membergosub;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_queueYouarenext;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_queueThereare;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_queueCallswaiting;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_queueQuantity1;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_queueQuantity2;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_queueHoldtime;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_queueMinutes;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_queueMinute;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_queueSeconds;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_queueThankyou;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_queueCallerannounce;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_queueReporthold;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_announceFrequency;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_announceToFirstUser;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_minAnnounceFrequency;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_announceRoundSeconds;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_announceHoldtime;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_announcePosition;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_announcePositionLimit;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_periodicAnnounce;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_periodicAnnounceFrequency;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_relativePeriodicAnnounce;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_randomPeriodicAnnounce;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_retry;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_wrapuptime;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_penaltymemberslimit;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_autofill;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_monitorType;

    /**
     * Database var type enum('yes','no','all')
     *
     * @var string
     */
    protected $_autopause;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_autopausedelay;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_autopausebusy;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_autopauseunavail;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_maxlen;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_servicelevel;

    /**
     * Database var type enum('ringall','leastrecent','fewestcalls','random','rrmemory','linear','wrandom','rrordered')
     *
     * @var string
     */
    protected $_strategy;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_joinempty;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_leavewhenempty;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_reportholdtime;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_memberdelay;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_weight;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_timeoutrestart;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_defaultrule;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_timeoutpriority;




    protected $_columnsList = array(
        'name'=>'name',
        'ast_musiconhold'=>'astMusiconhold',
        'announce'=>'announce',
        'context'=>'context',
        'timeout'=>'timeout',
        'ringinuse'=>'ringinuse',
        'setinterfacevar'=>'setinterfacevar',
        'setqueuevar'=>'setqueuevar',
        'setqueueentryvar'=>'setqueueentryvar',
        'monitor_format'=>'monitorFormat',
        'membermacro'=>'membermacro',
        'membergosub'=>'membergosub',
        'queue_youarenext'=>'queueYouarenext',
        'queue_thereare'=>'queueThereare',
        'queue_callswaiting'=>'queueCallswaiting',
        'queue_quantity1'=>'queueQuantity1',
        'queue_quantity2'=>'queueQuantity2',
        'queue_holdtime'=>'queueHoldtime',
        'queue_minutes'=>'queueMinutes',
        'queue_minute'=>'queueMinute',
        'queue_seconds'=>'queueSeconds',
        'queue_thankyou'=>'queueThankyou',
        'queue_callerannounce'=>'queueCallerannounce',
        'queue_reporthold'=>'queueReporthold',
        'announce_frequency'=>'announceFrequency',
        'announce_to_first_user'=>'announceToFirstUser',
        'min_announce_frequency'=>'minAnnounceFrequency',
        'announce_round_seconds'=>'announceRoundSeconds',
        'announce_holdtime'=>'announceHoldtime',
        'announce_position'=>'announcePosition',
        'announce_position_limit'=>'announcePositionLimit',
        'periodic_announce'=>'periodicAnnounce',
        'periodic_announce_frequency'=>'periodicAnnounceFrequency',
        'relative_periodic_announce'=>'relativePeriodicAnnounce',
        'random_periodic_announce'=>'randomPeriodicAnnounce',
        'retry'=>'retry',
        'wrapuptime'=>'wrapuptime',
        'penaltymemberslimit'=>'penaltymemberslimit',
        'autofill'=>'autofill',
        'monitor_type'=>'monitorType',
        'autopause'=>'autopause',
        'autopausedelay'=>'autopausedelay',
        'autopausebusy'=>'autopausebusy',
        'autopauseunavail'=>'autopauseunavail',
        'maxlen'=>'maxlen',
        'servicelevel'=>'servicelevel',
        'strategy'=>'strategy',
        'joinempty'=>'joinempty',
        'leavewhenempty'=>'leavewhenempty',
        'reportholdtime'=>'reportholdtime',
        'memberdelay'=>'memberdelay',
        'weight'=>'weight',
        'timeoutrestart'=>'timeoutrestart',
        'defaultrule'=>'defaultrule',
        'timeoutpriority'=>'timeoutpriority',
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
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setName($data)
    {

        if ($this->_name != $data) {
            $this->_logChange('name');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setAstMusiconhold($data)
    {

        if ($this->_astMusiconhold != $data) {
            $this->_logChange('astMusiconhold');
        }

        if (!is_null($data)) {
            $this->_astMusiconhold = (string) $data;
        } else {
            $this->_astMusiconhold = $data;
        }
        return $this;
    }

    /**
     * Gets column ast_musiconhold
     *
     * @return string
     */
    public function getAstMusiconhold()
    {
            return $this->_astMusiconhold;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setAnnounce($data)
    {

        if ($this->_announce != $data) {
            $this->_logChange('announce');
        }

        if (!is_null($data)) {
            $this->_announce = (string) $data;
        } else {
            $this->_announce = $data;
        }
        return $this;
    }

    /**
     * Gets column announce
     *
     * @return string
     */
    public function getAnnounce()
    {
            return $this->_announce;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setContext($data)
    {

        if ($this->_context != $data) {
            $this->_logChange('context');
        }

        if (!is_null($data)) {
            $this->_context = (string) $data;
        } else {
            $this->_context = $data;
        }
        return $this;
    }

    /**
     * Gets column context
     *
     * @return string
     */
    public function getContext()
    {
            return $this->_context;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setTimeout($data)
    {

        if ($this->_timeout != $data) {
            $this->_logChange('timeout');
        }

        if (!is_null($data)) {
            $this->_timeout = (int) $data;
        } else {
            $this->_timeout = $data;
        }
        return $this;
    }

    /**
     * Gets column timeout
     *
     * @return int
     */
    public function getTimeout()
    {
            return $this->_timeout;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setRinginuse($data)
    {

        if ($this->_ringinuse != $data) {
            $this->_logChange('ringinuse');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_ringinuseAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for ringinuse'));
            }
            $this->_ringinuse = (string) $data;
        } else {
            $this->_ringinuse = $data;
        }
        return $this;
    }

    /**
     * Gets column ringinuse
     *
     * @return string
     */
    public function getRinginuse()
    {
            return $this->_ringinuse;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setSetinterfacevar($data)
    {

        if ($this->_setinterfacevar != $data) {
            $this->_logChange('setinterfacevar');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_setinterfacevarAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for setinterfacevar'));
            }
            $this->_setinterfacevar = (string) $data;
        } else {
            $this->_setinterfacevar = $data;
        }
        return $this;
    }

    /**
     * Gets column setinterfacevar
     *
     * @return string
     */
    public function getSetinterfacevar()
    {
            return $this->_setinterfacevar;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setSetqueuevar($data)
    {

        if ($this->_setqueuevar != $data) {
            $this->_logChange('setqueuevar');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_setqueuevarAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for setqueuevar'));
            }
            $this->_setqueuevar = (string) $data;
        } else {
            $this->_setqueuevar = $data;
        }
        return $this;
    }

    /**
     * Gets column setqueuevar
     *
     * @return string
     */
    public function getSetqueuevar()
    {
            return $this->_setqueuevar;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setSetqueueentryvar($data)
    {

        if ($this->_setqueueentryvar != $data) {
            $this->_logChange('setqueueentryvar');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_setqueueentryvarAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for setqueueentryvar'));
            }
            $this->_setqueueentryvar = (string) $data;
        } else {
            $this->_setqueueentryvar = $data;
        }
        return $this;
    }

    /**
     * Gets column setqueueentryvar
     *
     * @return string
     */
    public function getSetqueueentryvar()
    {
            return $this->_setqueueentryvar;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setMonitorFormat($data)
    {

        if ($this->_monitorFormat != $data) {
            $this->_logChange('monitorFormat');
        }

        if (!is_null($data)) {
            $this->_monitorFormat = (string) $data;
        } else {
            $this->_monitorFormat = $data;
        }
        return $this;
    }

    /**
     * Gets column monitor_format
     *
     * @return string
     */
    public function getMonitorFormat()
    {
            return $this->_monitorFormat;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setMembermacro($data)
    {

        if ($this->_membermacro != $data) {
            $this->_logChange('membermacro');
        }

        if (!is_null($data)) {
            $this->_membermacro = (string) $data;
        } else {
            $this->_membermacro = $data;
        }
        return $this;
    }

    /**
     * Gets column membermacro
     *
     * @return string
     */
    public function getMembermacro()
    {
            return $this->_membermacro;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setMembergosub($data)
    {

        if ($this->_membergosub != $data) {
            $this->_logChange('membergosub');
        }

        if (!is_null($data)) {
            $this->_membergosub = (string) $data;
        } else {
            $this->_membergosub = $data;
        }
        return $this;
    }

    /**
     * Gets column membergosub
     *
     * @return string
     */
    public function getMembergosub()
    {
            return $this->_membergosub;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setQueueYouarenext($data)
    {

        if ($this->_queueYouarenext != $data) {
            $this->_logChange('queueYouarenext');
        }

        if (!is_null($data)) {
            $this->_queueYouarenext = (string) $data;
        } else {
            $this->_queueYouarenext = $data;
        }
        return $this;
    }

    /**
     * Gets column queue_youarenext
     *
     * @return string
     */
    public function getQueueYouarenext()
    {
            return $this->_queueYouarenext;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setQueueThereare($data)
    {

        if ($this->_queueThereare != $data) {
            $this->_logChange('queueThereare');
        }

        if (!is_null($data)) {
            $this->_queueThereare = (string) $data;
        } else {
            $this->_queueThereare = $data;
        }
        return $this;
    }

    /**
     * Gets column queue_thereare
     *
     * @return string
     */
    public function getQueueThereare()
    {
            return $this->_queueThereare;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setQueueCallswaiting($data)
    {

        if ($this->_queueCallswaiting != $data) {
            $this->_logChange('queueCallswaiting');
        }

        if (!is_null($data)) {
            $this->_queueCallswaiting = (string) $data;
        } else {
            $this->_queueCallswaiting = $data;
        }
        return $this;
    }

    /**
     * Gets column queue_callswaiting
     *
     * @return string
     */
    public function getQueueCallswaiting()
    {
            return $this->_queueCallswaiting;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setQueueQuantity1($data)
    {

        if ($this->_queueQuantity1 != $data) {
            $this->_logChange('queueQuantity1');
        }

        if (!is_null($data)) {
            $this->_queueQuantity1 = (string) $data;
        } else {
            $this->_queueQuantity1 = $data;
        }
        return $this;
    }

    /**
     * Gets column queue_quantity1
     *
     * @return string
     */
    public function getQueueQuantity1()
    {
            return $this->_queueQuantity1;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setQueueQuantity2($data)
    {

        if ($this->_queueQuantity2 != $data) {
            $this->_logChange('queueQuantity2');
        }

        if (!is_null($data)) {
            $this->_queueQuantity2 = (string) $data;
        } else {
            $this->_queueQuantity2 = $data;
        }
        return $this;
    }

    /**
     * Gets column queue_quantity2
     *
     * @return string
     */
    public function getQueueQuantity2()
    {
            return $this->_queueQuantity2;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setQueueHoldtime($data)
    {

        if ($this->_queueHoldtime != $data) {
            $this->_logChange('queueHoldtime');
        }

        if (!is_null($data)) {
            $this->_queueHoldtime = (string) $data;
        } else {
            $this->_queueHoldtime = $data;
        }
        return $this;
    }

    /**
     * Gets column queue_holdtime
     *
     * @return string
     */
    public function getQueueHoldtime()
    {
            return $this->_queueHoldtime;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setQueueMinutes($data)
    {

        if ($this->_queueMinutes != $data) {
            $this->_logChange('queueMinutes');
        }

        if (!is_null($data)) {
            $this->_queueMinutes = (string) $data;
        } else {
            $this->_queueMinutes = $data;
        }
        return $this;
    }

    /**
     * Gets column queue_minutes
     *
     * @return string
     */
    public function getQueueMinutes()
    {
            return $this->_queueMinutes;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setQueueMinute($data)
    {

        if ($this->_queueMinute != $data) {
            $this->_logChange('queueMinute');
        }

        if (!is_null($data)) {
            $this->_queueMinute = (string) $data;
        } else {
            $this->_queueMinute = $data;
        }
        return $this;
    }

    /**
     * Gets column queue_minute
     *
     * @return string
     */
    public function getQueueMinute()
    {
            return $this->_queueMinute;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setQueueSeconds($data)
    {

        if ($this->_queueSeconds != $data) {
            $this->_logChange('queueSeconds');
        }

        if (!is_null($data)) {
            $this->_queueSeconds = (string) $data;
        } else {
            $this->_queueSeconds = $data;
        }
        return $this;
    }

    /**
     * Gets column queue_seconds
     *
     * @return string
     */
    public function getQueueSeconds()
    {
            return $this->_queueSeconds;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setQueueThankyou($data)
    {

        if ($this->_queueThankyou != $data) {
            $this->_logChange('queueThankyou');
        }

        if (!is_null($data)) {
            $this->_queueThankyou = (string) $data;
        } else {
            $this->_queueThankyou = $data;
        }
        return $this;
    }

    /**
     * Gets column queue_thankyou
     *
     * @return string
     */
    public function getQueueThankyou()
    {
            return $this->_queueThankyou;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setQueueCallerannounce($data)
    {

        if ($this->_queueCallerannounce != $data) {
            $this->_logChange('queueCallerannounce');
        }

        if (!is_null($data)) {
            $this->_queueCallerannounce = (string) $data;
        } else {
            $this->_queueCallerannounce = $data;
        }
        return $this;
    }

    /**
     * Gets column queue_callerannounce
     *
     * @return string
     */
    public function getQueueCallerannounce()
    {
            return $this->_queueCallerannounce;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setQueueReporthold($data)
    {

        if ($this->_queueReporthold != $data) {
            $this->_logChange('queueReporthold');
        }

        if (!is_null($data)) {
            $this->_queueReporthold = (string) $data;
        } else {
            $this->_queueReporthold = $data;
        }
        return $this;
    }

    /**
     * Gets column queue_reporthold
     *
     * @return string
     */
    public function getQueueReporthold()
    {
            return $this->_queueReporthold;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setAnnounceFrequency($data)
    {

        if ($this->_announceFrequency != $data) {
            $this->_logChange('announceFrequency');
        }

        if (!is_null($data)) {
            $this->_announceFrequency = (int) $data;
        } else {
            $this->_announceFrequency = $data;
        }
        return $this;
    }

    /**
     * Gets column announce_frequency
     *
     * @return int
     */
    public function getAnnounceFrequency()
    {
            return $this->_announceFrequency;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setAnnounceToFirstUser($data)
    {

        if ($this->_announceToFirstUser != $data) {
            $this->_logChange('announceToFirstUser');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_announceToFirstUserAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for announceToFirstUser'));
            }
            $this->_announceToFirstUser = (string) $data;
        } else {
            $this->_announceToFirstUser = $data;
        }
        return $this;
    }

    /**
     * Gets column announce_to_first_user
     *
     * @return string
     */
    public function getAnnounceToFirstUser()
    {
            return $this->_announceToFirstUser;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setMinAnnounceFrequency($data)
    {

        if ($this->_minAnnounceFrequency != $data) {
            $this->_logChange('minAnnounceFrequency');
        }

        if (!is_null($data)) {
            $this->_minAnnounceFrequency = (int) $data;
        } else {
            $this->_minAnnounceFrequency = $data;
        }
        return $this;
    }

    /**
     * Gets column min_announce_frequency
     *
     * @return int
     */
    public function getMinAnnounceFrequency()
    {
            return $this->_minAnnounceFrequency;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setAnnounceRoundSeconds($data)
    {

        if ($this->_announceRoundSeconds != $data) {
            $this->_logChange('announceRoundSeconds');
        }

        if (!is_null($data)) {
            $this->_announceRoundSeconds = (int) $data;
        } else {
            $this->_announceRoundSeconds = $data;
        }
        return $this;
    }

    /**
     * Gets column announce_round_seconds
     *
     * @return int
     */
    public function getAnnounceRoundSeconds()
    {
            return $this->_announceRoundSeconds;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setAnnounceHoldtime($data)
    {

        if ($this->_announceHoldtime != $data) {
            $this->_logChange('announceHoldtime');
        }

        if (!is_null($data)) {
            $this->_announceHoldtime = (string) $data;
        } else {
            $this->_announceHoldtime = $data;
        }
        return $this;
    }

    /**
     * Gets column announce_holdtime
     *
     * @return string
     */
    public function getAnnounceHoldtime()
    {
            return $this->_announceHoldtime;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setAnnouncePosition($data)
    {

        if ($this->_announcePosition != $data) {
            $this->_logChange('announcePosition');
        }

        if (!is_null($data)) {
            $this->_announcePosition = (string) $data;
        } else {
            $this->_announcePosition = $data;
        }
        return $this;
    }

    /**
     * Gets column announce_position
     *
     * @return string
     */
    public function getAnnouncePosition()
    {
            return $this->_announcePosition;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setAnnouncePositionLimit($data)
    {

        if ($this->_announcePositionLimit != $data) {
            $this->_logChange('announcePositionLimit');
        }

        if (!is_null($data)) {
            $this->_announcePositionLimit = (int) $data;
        } else {
            $this->_announcePositionLimit = $data;
        }
        return $this;
    }

    /**
     * Gets column announce_position_limit
     *
     * @return int
     */
    public function getAnnouncePositionLimit()
    {
            return $this->_announcePositionLimit;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setPeriodicAnnounce($data)
    {

        if ($this->_periodicAnnounce != $data) {
            $this->_logChange('periodicAnnounce');
        }

        if (!is_null($data)) {
            $this->_periodicAnnounce = (string) $data;
        } else {
            $this->_periodicAnnounce = $data;
        }
        return $this;
    }

    /**
     * Gets column periodic_announce
     *
     * @return string
     */
    public function getPeriodicAnnounce()
    {
            return $this->_periodicAnnounce;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setPeriodicAnnounceFrequency($data)
    {

        if ($this->_periodicAnnounceFrequency != $data) {
            $this->_logChange('periodicAnnounceFrequency');
        }

        if (!is_null($data)) {
            $this->_periodicAnnounceFrequency = (int) $data;
        } else {
            $this->_periodicAnnounceFrequency = $data;
        }
        return $this;
    }

    /**
     * Gets column periodic_announce_frequency
     *
     * @return int
     */
    public function getPeriodicAnnounceFrequency()
    {
            return $this->_periodicAnnounceFrequency;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setRelativePeriodicAnnounce($data)
    {

        if ($this->_relativePeriodicAnnounce != $data) {
            $this->_logChange('relativePeriodicAnnounce');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_relativePeriodicAnnounceAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for relativePeriodicAnnounce'));
            }
            $this->_relativePeriodicAnnounce = (string) $data;
        } else {
            $this->_relativePeriodicAnnounce = $data;
        }
        return $this;
    }

    /**
     * Gets column relative_periodic_announce
     *
     * @return string
     */
    public function getRelativePeriodicAnnounce()
    {
            return $this->_relativePeriodicAnnounce;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setRandomPeriodicAnnounce($data)
    {

        if ($this->_randomPeriodicAnnounce != $data) {
            $this->_logChange('randomPeriodicAnnounce');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_randomPeriodicAnnounceAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for randomPeriodicAnnounce'));
            }
            $this->_randomPeriodicAnnounce = (string) $data;
        } else {
            $this->_randomPeriodicAnnounce = $data;
        }
        return $this;
    }

    /**
     * Gets column random_periodic_announce
     *
     * @return string
     */
    public function getRandomPeriodicAnnounce()
    {
            return $this->_randomPeriodicAnnounce;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setRetry($data)
    {

        if ($this->_retry != $data) {
            $this->_logChange('retry');
        }

        if (!is_null($data)) {
            $this->_retry = (int) $data;
        } else {
            $this->_retry = $data;
        }
        return $this;
    }

    /**
     * Gets column retry
     *
     * @return int
     */
    public function getRetry()
    {
            return $this->_retry;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setWrapuptime($data)
    {

        if ($this->_wrapuptime != $data) {
            $this->_logChange('wrapuptime');
        }

        if (!is_null($data)) {
            $this->_wrapuptime = (int) $data;
        } else {
            $this->_wrapuptime = $data;
        }
        return $this;
    }

    /**
     * Gets column wrapuptime
     *
     * @return int
     */
    public function getWrapuptime()
    {
            return $this->_wrapuptime;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setPenaltymemberslimit($data)
    {

        if ($this->_penaltymemberslimit != $data) {
            $this->_logChange('penaltymemberslimit');
        }

        if (!is_null($data)) {
            $this->_penaltymemberslimit = (int) $data;
        } else {
            $this->_penaltymemberslimit = $data;
        }
        return $this;
    }

    /**
     * Gets column penaltymemberslimit
     *
     * @return int
     */
    public function getPenaltymemberslimit()
    {
            return $this->_penaltymemberslimit;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setAutofill($data)
    {

        if ($this->_autofill != $data) {
            $this->_logChange('autofill');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_autofillAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for autofill'));
            }
            $this->_autofill = (string) $data;
        } else {
            $this->_autofill = $data;
        }
        return $this;
    }

    /**
     * Gets column autofill
     *
     * @return string
     */
    public function getAutofill()
    {
            return $this->_autofill;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setMonitorType($data)
    {

        if ($this->_monitorType != $data) {
            $this->_logChange('monitorType');
        }

        if (!is_null($data)) {
            $this->_monitorType = (string) $data;
        } else {
            $this->_monitorType = $data;
        }
        return $this;
    }

    /**
     * Gets column monitor_type
     *
     * @return string
     */
    public function getMonitorType()
    {
            return $this->_monitorType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setAutopause($data)
    {

        if ($this->_autopause != $data) {
            $this->_logChange('autopause');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_autopauseAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for autopause'));
            }
            $this->_autopause = (string) $data;
        } else {
            $this->_autopause = $data;
        }
        return $this;
    }

    /**
     * Gets column autopause
     *
     * @return string
     */
    public function getAutopause()
    {
            return $this->_autopause;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setAutopausedelay($data)
    {

        if ($this->_autopausedelay != $data) {
            $this->_logChange('autopausedelay');
        }

        if (!is_null($data)) {
            $this->_autopausedelay = (int) $data;
        } else {
            $this->_autopausedelay = $data;
        }
        return $this;
    }

    /**
     * Gets column autopausedelay
     *
     * @return int
     */
    public function getAutopausedelay()
    {
            return $this->_autopausedelay;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setAutopausebusy($data)
    {

        if ($this->_autopausebusy != $data) {
            $this->_logChange('autopausebusy');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_autopausebusyAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for autopausebusy'));
            }
            $this->_autopausebusy = (string) $data;
        } else {
            $this->_autopausebusy = $data;
        }
        return $this;
    }

    /**
     * Gets column autopausebusy
     *
     * @return string
     */
    public function getAutopausebusy()
    {
            return $this->_autopausebusy;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setAutopauseunavail($data)
    {

        if ($this->_autopauseunavail != $data) {
            $this->_logChange('autopauseunavail');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_autopauseunavailAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for autopauseunavail'));
            }
            $this->_autopauseunavail = (string) $data;
        } else {
            $this->_autopauseunavail = $data;
        }
        return $this;
    }

    /**
     * Gets column autopauseunavail
     *
     * @return string
     */
    public function getAutopauseunavail()
    {
            return $this->_autopauseunavail;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setMaxlen($data)
    {

        if ($this->_maxlen != $data) {
            $this->_logChange('maxlen');
        }

        if (!is_null($data)) {
            $this->_maxlen = (int) $data;
        } else {
            $this->_maxlen = $data;
        }
        return $this;
    }

    /**
     * Gets column maxlen
     *
     * @return int
     */
    public function getMaxlen()
    {
            return $this->_maxlen;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setServicelevel($data)
    {

        if ($this->_servicelevel != $data) {
            $this->_logChange('servicelevel');
        }

        if (!is_null($data)) {
            $this->_servicelevel = (int) $data;
        } else {
            $this->_servicelevel = $data;
        }
        return $this;
    }

    /**
     * Gets column servicelevel
     *
     * @return int
     */
    public function getServicelevel()
    {
            return $this->_servicelevel;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setStrategy($data)
    {

        if ($this->_strategy != $data) {
            $this->_logChange('strategy');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_strategyAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for strategy'));
            }
            $this->_strategy = (string) $data;
        } else {
            $this->_strategy = $data;
        }
        return $this;
    }

    /**
     * Gets column strategy
     *
     * @return string
     */
    public function getStrategy()
    {
            return $this->_strategy;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setJoinempty($data)
    {

        if ($this->_joinempty != $data) {
            $this->_logChange('joinempty');
        }

        if (!is_null($data)) {
            $this->_joinempty = (string) $data;
        } else {
            $this->_joinempty = $data;
        }
        return $this;
    }

    /**
     * Gets column joinempty
     *
     * @return string
     */
    public function getJoinempty()
    {
            return $this->_joinempty;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setLeavewhenempty($data)
    {

        if ($this->_leavewhenempty != $data) {
            $this->_logChange('leavewhenempty');
        }

        if (!is_null($data)) {
            $this->_leavewhenempty = (string) $data;
        } else {
            $this->_leavewhenempty = $data;
        }
        return $this;
    }

    /**
     * Gets column leavewhenempty
     *
     * @return string
     */
    public function getLeavewhenempty()
    {
            return $this->_leavewhenempty;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setReportholdtime($data)
    {

        if ($this->_reportholdtime != $data) {
            $this->_logChange('reportholdtime');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_reportholdtimeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for reportholdtime'));
            }
            $this->_reportholdtime = (string) $data;
        } else {
            $this->_reportholdtime = $data;
        }
        return $this;
    }

    /**
     * Gets column reportholdtime
     *
     * @return string
     */
    public function getReportholdtime()
    {
            return $this->_reportholdtime;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setMemberdelay($data)
    {

        if ($this->_memberdelay != $data) {
            $this->_logChange('memberdelay');
        }

        if (!is_null($data)) {
            $this->_memberdelay = (int) $data;
        } else {
            $this->_memberdelay = $data;
        }
        return $this;
    }

    /**
     * Gets column memberdelay
     *
     * @return int
     */
    public function getMemberdelay()
    {
            return $this->_memberdelay;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setWeight($data)
    {

        if ($this->_weight != $data) {
            $this->_logChange('weight');
        }

        if (!is_null($data)) {
            $this->_weight = (int) $data;
        } else {
            $this->_weight = $data;
        }
        return $this;
    }

    /**
     * Gets column weight
     *
     * @return int
     */
    public function getWeight()
    {
            return $this->_weight;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setTimeoutrestart($data)
    {

        if ($this->_timeoutrestart != $data) {
            $this->_logChange('timeoutrestart');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_timeoutrestartAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for timeoutrestart'));
            }
            $this->_timeoutrestart = (string) $data;
        } else {
            $this->_timeoutrestart = $data;
        }
        return $this;
    }

    /**
     * Gets column timeoutrestart
     *
     * @return string
     */
    public function getTimeoutrestart()
    {
            return $this->_timeoutrestart;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setDefaultrule($data)
    {

        if ($this->_defaultrule != $data) {
            $this->_logChange('defaultrule');
        }

        if (!is_null($data)) {
            $this->_defaultrule = (string) $data;
        } else {
            $this->_defaultrule = $data;
        }
        return $this;
    }

    /**
     * Gets column defaultrule
     *
     * @return string
     */
    public function getDefaultrule()
    {
            return $this->_defaultrule;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstQueues
     */
    public function setTimeoutpriority($data)
    {

        if ($this->_timeoutpriority != $data) {
            $this->_logChange('timeoutpriority');
        }

        if (!is_null($data)) {
            $this->_timeoutpriority = (string) $data;
        } else {
            $this->_timeoutpriority = $data;
        }
        return $this;
    }

    /**
     * Gets column timeoutpriority
     *
     * @return string
     */
    public function getTimeoutpriority()
    {
            return $this->_timeoutpriority;
    }


    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\AstQueues
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\AstQueues')) {

                $this->setMapper(new \Oasis\Mapper\Sql\AstQueues);

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
     * @return null | \Oasis\Model\Validator\AstQueues
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\AstQueues')) {

                $this->setValidator(new \Oasis\Validator\AstQueues);
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
     * @see \Mapper\Sql\AstQueues::delete
     * @return int|boolean Number of rows deleted or boolean if doing soft delete
     */
    public function deleteRowByPrimaryKey()
    {
        if ($this->getName() === null) {
            $this->_logger->log('The value for Name cannot be null in deleteRowByPrimaryKey for ' . get_class($this), \Zend_Log::ERR);
            throw new \Exception('Primary Key does not contain a value');
        }

        return $this->getMapper()->getDbTable()->delete(
            'name = ' .
             $this->getMapper()->getDbTable()->getAdapter()->quote($this->getName())
        );
    }
}
