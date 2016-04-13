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
class ExternalCallFilters extends ModelAbstract
{

    protected $_holidayTargetTypeAcceptedValues = array(
        'number',
        'extension',
        'voicemail',
    );
    protected $_outOfScheduleTargetTypeAcceptedValues = array(
        'number',
        'extension',
        'voicemail',
    );

    /**
     * [uuid:php]
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_id;

    /**
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_companyId;

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
    protected $_welcomeLocutionId;

    /**
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_holidayLocutionId;

    /**
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_outOfScheduleLocutionId;

    /**
     * [enum:number|extension|voicemail]
     * Database var type varchar
     *
     * @var string
     */
    protected $_holidayTargetType;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_holidayNumberValue;

    /**
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_holidayExtensionId;

    /**
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_holidayVoiceMailUserId;

    /**
     * [enum:number|extension|voicemail]
     * Database var type varchar
     *
     * @var string
     */
    protected $_outOfScheduleTargetType;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_outOfScheduleNumberValue;

    /**
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_outOfScheduleExtensionId;

    /**
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_outOfScheduleVoiceMailUserId;


    /**
     * Parent relation ExternalCallFilters_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;

    /**
     * Parent relation ExternalCallFilters_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\Locutions
     */
    protected $_WelcomeLocution;

    /**
     * Parent relation ExternalCallFilters_ibfk_3
     *
     * @var \IvozProvider\Model\Raw\Locutions
     */
    protected $_HolidayLocution;

    /**
     * Parent relation ExternalCallFilters_ibfk_4
     *
     * @var \IvozProvider\Model\Raw\Locutions
     */
    protected $_OutOfScheduleLocution;

    /**
     * Parent relation ExternalCallFilters_ibfk_5
     *
     * @var \IvozProvider\Model\Raw\Extensions
     */
    protected $_HolidayExtension;

    /**
     * Parent relation ExternalCallFilters_ibfk_6
     *
     * @var \IvozProvider\Model\Raw\Extensions
     */
    protected $_OutOfScheduleExtension;

    /**
     * Parent relation ExternalCallFilters_ibfk_7
     *
     * @var \IvozProvider\Model\Raw\Users
     */
    protected $_HolidayVoiceMailUser;

    /**
     * Parent relation ExternalCallFilters_ibfk_8
     *
     * @var \IvozProvider\Model\Raw\Users
     */
    protected $_OutOfScheduleVoiceMailUser;


    /**
     * Dependent relation DDIs_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\DDIs[]
     */
    protected $_DDIs;

    /**
     * Dependent relation ExternalCallFilterRelCalendars_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\ExternalCallFilterRelCalendars[]
     */
    protected $_ExternalCallFilterRelCalendars;

    /**
     * Dependent relation ExternalCallFilterRelSchedules_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\ExternalCallFilterRelSchedules[]
     */
    protected $_ExternalCallFilterRelSchedules;

    protected $_columnsList = array(
        'id'=>'id',
        'companyId'=>'companyId',
        'name'=>'name',
        'welcomeLocutionId'=>'welcomeLocutionId',
        'holidayLocutionId'=>'holidayLocutionId',
        'outOfScheduleLocutionId'=>'outOfScheduleLocutionId',
        'holidayTargetType'=>'holidayTargetType',
        'holidayNumberValue'=>'holidayNumberValue',
        'holidayExtensionId'=>'holidayExtensionId',
        'holidayVoiceMailUserId'=>'holidayVoiceMailUserId',
        'outOfScheduleTargetType'=>'outOfScheduleTargetType',
        'outOfScheduleNumberValue'=>'outOfScheduleNumberValue',
        'outOfScheduleExtensionId'=>'outOfScheduleExtensionId',
        'outOfScheduleVoiceMailUserId'=>'outOfScheduleVoiceMailUserId',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'id'=> array('uuid:php'),
            'holidayTargetType'=> array('enum:number|extension|voicemail'),
            'outOfScheduleTargetType'=> array('enum:number|extension|voicemail'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'ExternalCallFiltersIbfk1'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
            'ExternalCallFiltersIbfk2'=> array(
                    'property' => 'WelcomeLocution',
                    'table_name' => 'Locutions',
                ),
            'ExternalCallFiltersIbfk3'=> array(
                    'property' => 'HolidayLocution',
                    'table_name' => 'Locutions',
                ),
            'ExternalCallFiltersIbfk4'=> array(
                    'property' => 'OutOfScheduleLocution',
                    'table_name' => 'Locutions',
                ),
            'ExternalCallFiltersIbfk5'=> array(
                    'property' => 'HolidayExtension',
                    'table_name' => 'Extensions',
                ),
            'ExternalCallFiltersIbfk6'=> array(
                    'property' => 'OutOfScheduleExtension',
                    'table_name' => 'Extensions',
                ),
            'ExternalCallFiltersIbfk7'=> array(
                    'property' => 'HolidayVoiceMailUser',
                    'table_name' => 'Users',
                ),
            'ExternalCallFiltersIbfk8'=> array(
                    'property' => 'OutOfScheduleVoiceMailUser',
                    'table_name' => 'Users',
                ),
        ));

        $this->setDependentList(array(
            'DDIsIbfk2' => array(
                    'property' => 'DDIs',
                    'table_name' => 'DDIs',
                ),
            'ExternalCallFilterRelCalendarsIbfk1' => array(
                    'property' => 'ExternalCallFilterRelCalendars',
                    'table_name' => 'ExternalCallFilterRelCalendars',
                ),
            'ExternalCallFilterRelSchedulesIbfk1' => array(
                    'property' => 'ExternalCallFilterRelSchedules',
                    'table_name' => 'ExternalCallFilterRelSchedules',
                ),
        ));

        $this->setOnDeleteCascadeRelationships(array(
            'ExternalCallFilterRelCalendars_ibfk_1',
            'ExternalCallFilterRelSchedules_ibfk_1'
        ));

        $this->setOnDeleteSetNullRelationships(array(
            'DDIs_ibfk_2'
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
     * @param binary $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
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
     * @param binary $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function setCompanyId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_companyId != $data) {
            $this->_logChange('companyId');
        }

        $this->_companyId = $data;
        return $this;
    }

    /**
     * Gets column companyId
     *
     * @return binary
     */
    public function getCompanyId()
    {
        return $this->_companyId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function setName($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
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
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function setWelcomeLocutionId($data)
    {

        if ($this->_welcomeLocutionId != $data) {
            $this->_logChange('welcomeLocutionId');
        }

        $this->_welcomeLocutionId = $data;
        return $this;
    }

    /**
     * Gets column welcomeLocutionId
     *
     * @return binary
     */
    public function getWelcomeLocutionId()
    {
        return $this->_welcomeLocutionId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param binary $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function setHolidayLocutionId($data)
    {

        if ($this->_holidayLocutionId != $data) {
            $this->_logChange('holidayLocutionId');
        }

        $this->_holidayLocutionId = $data;
        return $this;
    }

    /**
     * Gets column holidayLocutionId
     *
     * @return binary
     */
    public function getHolidayLocutionId()
    {
        return $this->_holidayLocutionId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param binary $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function setOutOfScheduleLocutionId($data)
    {

        if ($this->_outOfScheduleLocutionId != $data) {
            $this->_logChange('outOfScheduleLocutionId');
        }

        $this->_outOfScheduleLocutionId = $data;
        return $this;
    }

    /**
     * Gets column outOfScheduleLocutionId
     *
     * @return binary
     */
    public function getOutOfScheduleLocutionId()
    {
        return $this->_outOfScheduleLocutionId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function setHolidayTargetType($data)
    {

        if ($this->_holidayTargetType != $data) {
            $this->_logChange('holidayTargetType');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_holidayTargetType = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_holidayTargetTypeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for holidayTargetType'));
            }
            $this->_holidayTargetType = (string) $data;

        } else {
            $this->_holidayTargetType = $data;
        }
        return $this;
    }

    /**
     * Gets column holidayTargetType
     *
     * @return string
     */
    public function getHolidayTargetType()
    {
        return $this->_holidayTargetType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function setHolidayNumberValue($data)
    {

        if ($this->_holidayNumberValue != $data) {
            $this->_logChange('holidayNumberValue');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_holidayNumberValue = $data;

        } else if (!is_null($data)) {
            $this->_holidayNumberValue = (string) $data;

        } else {
            $this->_holidayNumberValue = $data;
        }
        return $this;
    }

    /**
     * Gets column holidayNumberValue
     *
     * @return string
     */
    public function getHolidayNumberValue()
    {
        return $this->_holidayNumberValue;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param binary $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function setHolidayExtensionId($data)
    {

        if ($this->_holidayExtensionId != $data) {
            $this->_logChange('holidayExtensionId');
        }

        $this->_holidayExtensionId = $data;
        return $this;
    }

    /**
     * Gets column holidayExtensionId
     *
     * @return binary
     */
    public function getHolidayExtensionId()
    {
        return $this->_holidayExtensionId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param binary $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function setHolidayVoiceMailUserId($data)
    {

        if ($this->_holidayVoiceMailUserId != $data) {
            $this->_logChange('holidayVoiceMailUserId');
        }

        $this->_holidayVoiceMailUserId = $data;
        return $this;
    }

    /**
     * Gets column holidayVoiceMailUserId
     *
     * @return binary
     */
    public function getHolidayVoiceMailUserId()
    {
        return $this->_holidayVoiceMailUserId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function setOutOfScheduleTargetType($data)
    {

        if ($this->_outOfScheduleTargetType != $data) {
            $this->_logChange('outOfScheduleTargetType');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_outOfScheduleTargetType = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_outOfScheduleTargetTypeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for outOfScheduleTargetType'));
            }
            $this->_outOfScheduleTargetType = (string) $data;

        } else {
            $this->_outOfScheduleTargetType = $data;
        }
        return $this;
    }

    /**
     * Gets column outOfScheduleTargetType
     *
     * @return string
     */
    public function getOutOfScheduleTargetType()
    {
        return $this->_outOfScheduleTargetType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function setOutOfScheduleNumberValue($data)
    {

        if ($this->_outOfScheduleNumberValue != $data) {
            $this->_logChange('outOfScheduleNumberValue');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_outOfScheduleNumberValue = $data;

        } else if (!is_null($data)) {
            $this->_outOfScheduleNumberValue = (string) $data;

        } else {
            $this->_outOfScheduleNumberValue = $data;
        }
        return $this;
    }

    /**
     * Gets column outOfScheduleNumberValue
     *
     * @return string
     */
    public function getOutOfScheduleNumberValue()
    {
        return $this->_outOfScheduleNumberValue;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param binary $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function setOutOfScheduleExtensionId($data)
    {

        if ($this->_outOfScheduleExtensionId != $data) {
            $this->_logChange('outOfScheduleExtensionId');
        }

        $this->_outOfScheduleExtensionId = $data;
        return $this;
    }

    /**
     * Gets column outOfScheduleExtensionId
     *
     * @return binary
     */
    public function getOutOfScheduleExtensionId()
    {
        return $this->_outOfScheduleExtensionId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param binary $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function setOutOfScheduleVoiceMailUserId($data)
    {

        if ($this->_outOfScheduleVoiceMailUserId != $data) {
            $this->_logChange('outOfScheduleVoiceMailUserId');
        }

        $this->_outOfScheduleVoiceMailUserId = $data;
        return $this;
    }

    /**
     * Gets column outOfScheduleVoiceMailUserId
     *
     * @return binary
     */
    public function getOutOfScheduleVoiceMailUserId()
    {
        return $this->_outOfScheduleVoiceMailUserId;
    }

    /**
     * Sets parent relation Company
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
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

        $this->_setLoaded('ExternalCallFiltersIbfk1');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExternalCallFiltersIbfk1';

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
     * Sets parent relation WelcomeLocution
     *
     * @param \IvozProvider\Model\Raw\Locutions $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function setWelcomeLocution(\IvozProvider\Model\Raw\Locutions $data)
    {
        $this->_WelcomeLocution = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setWelcomeLocutionId($primaryKey);
        }

        $this->_setLoaded('ExternalCallFiltersIbfk2');
        return $this;
    }

    /**
     * Gets parent WelcomeLocution
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Locutions
     */
    public function getWelcomeLocution($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExternalCallFiltersIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_WelcomeLocution = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_WelcomeLocution;
    }

    /**
     * Sets parent relation HolidayLocution
     *
     * @param \IvozProvider\Model\Raw\Locutions $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function setHolidayLocution(\IvozProvider\Model\Raw\Locutions $data)
    {
        $this->_HolidayLocution = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setHolidayLocutionId($primaryKey);
        }

        $this->_setLoaded('ExternalCallFiltersIbfk3');
        return $this;
    }

    /**
     * Gets parent HolidayLocution
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Locutions
     */
    public function getHolidayLocution($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExternalCallFiltersIbfk3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_HolidayLocution = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_HolidayLocution;
    }

    /**
     * Sets parent relation OutOfScheduleLocution
     *
     * @param \IvozProvider\Model\Raw\Locutions $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function setOutOfScheduleLocution(\IvozProvider\Model\Raw\Locutions $data)
    {
        $this->_OutOfScheduleLocution = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setOutOfScheduleLocutionId($primaryKey);
        }

        $this->_setLoaded('ExternalCallFiltersIbfk4');
        return $this;
    }

    /**
     * Gets parent OutOfScheduleLocution
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Locutions
     */
    public function getOutOfScheduleLocution($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExternalCallFiltersIbfk4';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_OutOfScheduleLocution = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_OutOfScheduleLocution;
    }

    /**
     * Sets parent relation HolidayExtension
     *
     * @param \IvozProvider\Model\Raw\Extensions $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function setHolidayExtension(\IvozProvider\Model\Raw\Extensions $data)
    {
        $this->_HolidayExtension = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setHolidayExtensionId($primaryKey);
        }

        $this->_setLoaded('ExternalCallFiltersIbfk5');
        return $this;
    }

    /**
     * Gets parent HolidayExtension
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Extensions
     */
    public function getHolidayExtension($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExternalCallFiltersIbfk5';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_HolidayExtension = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_HolidayExtension;
    }

    /**
     * Sets parent relation OutOfScheduleExtension
     *
     * @param \IvozProvider\Model\Raw\Extensions $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function setOutOfScheduleExtension(\IvozProvider\Model\Raw\Extensions $data)
    {
        $this->_OutOfScheduleExtension = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setOutOfScheduleExtensionId($primaryKey);
        }

        $this->_setLoaded('ExternalCallFiltersIbfk6');
        return $this;
    }

    /**
     * Gets parent OutOfScheduleExtension
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Extensions
     */
    public function getOutOfScheduleExtension($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExternalCallFiltersIbfk6';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_OutOfScheduleExtension = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_OutOfScheduleExtension;
    }

    /**
     * Sets parent relation HolidayVoiceMailUser
     *
     * @param \IvozProvider\Model\Raw\Users $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function setHolidayVoiceMailUser(\IvozProvider\Model\Raw\Users $data)
    {
        $this->_HolidayVoiceMailUser = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setHolidayVoiceMailUserId($primaryKey);
        }

        $this->_setLoaded('ExternalCallFiltersIbfk7');
        return $this;
    }

    /**
     * Gets parent HolidayVoiceMailUser
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Users
     */
    public function getHolidayVoiceMailUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExternalCallFiltersIbfk7';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_HolidayVoiceMailUser = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_HolidayVoiceMailUser;
    }

    /**
     * Sets parent relation OutOfScheduleVoiceMailUser
     *
     * @param \IvozProvider\Model\Raw\Users $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function setOutOfScheduleVoiceMailUser(\IvozProvider\Model\Raw\Users $data)
    {
        $this->_OutOfScheduleVoiceMailUser = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setOutOfScheduleVoiceMailUserId($primaryKey);
        }

        $this->_setLoaded('ExternalCallFiltersIbfk8');
        return $this;
    }

    /**
     * Gets parent OutOfScheduleVoiceMailUser
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Users
     */
    public function getOutOfScheduleVoiceMailUser($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExternalCallFiltersIbfk8';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_OutOfScheduleVoiceMailUser = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_OutOfScheduleVoiceMailUser;
    }

    /**
     * Sets dependent relations DDIs_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\DDIs
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
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
     * Sets dependent relations DDIs_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\DDIs $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function addDDIs(\IvozProvider\Model\Raw\DDIs $data)
    {
        $this->_DDIs[] = $data;
        $this->_setLoaded('DDIsIbfk2');
        return $this;
    }

    /**
     * Gets dependent DDIs_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\DDIs
     */
    public function getDDIs($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk2';

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
     * Sets dependent relations ExternalCallFilterRelCalendars_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\ExternalCallFilterRelCalendars
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function setExternalCallFilterRelCalendars(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ExternalCallFilterRelCalendars === null) {

                $this->getExternalCallFilterRelCalendars();
            }

            $oldRelations = $this->_ExternalCallFilterRelCalendars;

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

        $this->_ExternalCallFilterRelCalendars = array();

        foreach ($data as $object) {
            $this->addExternalCallFilterRelCalendars($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations ExternalCallFilterRelCalendars_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\ExternalCallFilterRelCalendars $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function addExternalCallFilterRelCalendars(\IvozProvider\Model\Raw\ExternalCallFilterRelCalendars $data)
    {
        $this->_ExternalCallFilterRelCalendars[] = $data;
        $this->_setLoaded('ExternalCallFilterRelCalendarsIbfk1');
        return $this;
    }

    /**
     * Gets dependent ExternalCallFilterRelCalendars_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\ExternalCallFilterRelCalendars
     */
    public function getExternalCallFilterRelCalendars($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExternalCallFilterRelCalendarsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ExternalCallFilterRelCalendars = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ExternalCallFilterRelCalendars;
    }

    /**
     * Sets dependent relations ExternalCallFilterRelSchedules_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\ExternalCallFilterRelSchedules
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function setExternalCallFilterRelSchedules(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_ExternalCallFilterRelSchedules === null) {

                $this->getExternalCallFilterRelSchedules();
            }

            $oldRelations = $this->_ExternalCallFilterRelSchedules;

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

        $this->_ExternalCallFilterRelSchedules = array();

        foreach ($data as $object) {
            $this->addExternalCallFilterRelSchedules($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations ExternalCallFilterRelSchedules_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\ExternalCallFilterRelSchedules $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function addExternalCallFilterRelSchedules(\IvozProvider\Model\Raw\ExternalCallFilterRelSchedules $data)
    {
        $this->_ExternalCallFilterRelSchedules[] = $data;
        $this->_setLoaded('ExternalCallFilterRelSchedulesIbfk1');
        return $this;
    }

    /**
     * Gets dependent ExternalCallFilterRelSchedules_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\ExternalCallFilterRelSchedules
     */
    public function getExternalCallFilterRelSchedules($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExternalCallFilterRelSchedulesIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_ExternalCallFilterRelSchedules = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_ExternalCallFilterRelSchedules;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\ExternalCallFilters
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\ExternalCallFilters')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\ExternalCallFilters);

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
     * @return null | \IvozProvider\Model\Validator\ExternalCallFilters
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\ExternalCallFilters')) {

                $this->setValidator(new \IvozProvider\Validator\ExternalCallFilters);
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
     * @see \Mapper\Sql\ExternalCallFilters::delete
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