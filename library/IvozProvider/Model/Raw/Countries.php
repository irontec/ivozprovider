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
class Countries extends ModelAbstract
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
    protected $_code;

    /**
     * [ml]
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
    protected $_nameEn;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_nameEs;

    /**
     * [ml]
     * Database var type varchar
     *
     * @var string
     */
    protected $_zone;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_zoneEn;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_zoneEs;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_callingCode;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_intCode;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_e164Pattern;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_nationalCC;



    /**
     * Dependent relation Companies_ibfk_9
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Companies[]
     */
    protected $_Companies;

    /**
     * Dependent relation DDIs_ibfk_9
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\DDIs[]
     */
    protected $_DDIs;

    /**
     * Dependent relation Friends_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Friends[]
     */
    protected $_Friends;

    /**
     * Dependent relation MatchListPatterns_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\MatchListPatterns[]
     */
    protected $_MatchListPatterns;

    /**
     * Dependent relation RetailAccounts_ibfk_3
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\RetailAccounts[]
     */
    protected $_RetailAccounts;

    /**
     * Dependent relation Timezones_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Timezones[]
     */
    protected $_Timezones;

    /**
     * Dependent relation TransformationRulesetGroupsTrunks_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks[]
     */
    protected $_TransformationRulesetGroupsTrunks;

    /**
     * Dependent relation Users_ibfk_12
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Users[]
     */
    protected $_Users;

    protected $_columnsList = array(
        'id'=>'id',
        'code'=>'code',
        'name'=>'name',
        'name_en'=>'nameEn',
        'name_es'=>'nameEs',
        'zone'=>'zone',
        'zone_en'=>'zoneEn',
        'zone_es'=>'zoneEs',
        'calling_code'=>'callingCode',
        'intCode'=>'intCode',
        'e164Pattern'=>'e164Pattern',
        'nationalCC'=>'nationalCC',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'name'=> array('ml'),
            'zone'=> array('ml'),
        ));

        $this->setMultiLangColumnsList(array(
            'name'=>'Name',
            'zone'=>'Zone',
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
        ));

        $this->setDependentList(array(
            'CompaniesIbfk9' => array(
                    'property' => 'Companies',
                    'table_name' => 'Companies',
                ),
            'DDIsIbfk9' => array(
                    'property' => 'DDIs',
                    'table_name' => 'DDIs',
                ),
            'FriendsIbfk2' => array(
                    'property' => 'Friends',
                    'table_name' => 'Friends',
                ),
            'MatchListPatternsIbfk2' => array(
                    'property' => 'MatchListPatterns',
                    'table_name' => 'MatchListPatterns',
                ),
            'RetailAccountsIbfk3' => array(
                    'property' => 'RetailAccounts',
                    'table_name' => 'RetailAccounts',
                ),
            'TimezonesIbfk2' => array(
                    'property' => 'Timezones',
                    'table_name' => 'Timezones',
                ),
            'TransformationRulesetGroupsTrunksIbfk2' => array(
                    'property' => 'TransformationRulesetGroupsTrunks',
                    'table_name' => 'TransformationRulesetGroupsTrunks',
                ),
            'UsersIbfk12' => array(
                    'property' => 'Users',
                    'table_name' => 'Users',
                ),
        ));


        $this->setOnDeleteSetNullRelationships(array(
            'Companies_ibfk_9'
        ));


        $this->_defaultValues = array(
            'code' => '',
            'zoneEn' => '',
            'zoneEs' => '',
            'nationalCC' => '0',
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
     * @return \IvozProvider\Model\Raw\Countries
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
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function setCode($data)
    {

        if ($this->_code != $data) {
            $this->_logChange('code', $this->_code, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_code = $data;

        } else if (!is_null($data)) {
            $this->_code = (string) $data;

        } else {
            $this->_code = $data;
        }
        return $this;
    }

    /**
     * Gets column code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->_code;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function setName($data, $language = '')
    {

        $language = $this->_getCurrentLanguage($language);

        $methodName = "setName". ucfirst(str_replace('_', '', $language));
        if (!method_exists($this, $methodName)) {

            // new \Exception('Unavailable language');
            $this->_name = $data;
            return $this;
        }
        $this->$methodName($data);
        return $this;
    }

    /**
     * Gets column name
     *
     * @return string
     */
    public function getName($language = '')
    {
        $language = $this->_getCurrentLanguage($language);

        $methodName = "getName". ucfirst(str_replace('_', '', $language));
        if (!method_exists($this, $methodName)) {

            // new \Exception('Unavailable language');
            return $this->_name;
        }

        return $this->$methodName();
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function setNameEn($data)
    {

        if ($this->_nameEn != $data) {
            $this->_logChange('nameEn', $this->_nameEn, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_nameEn = $data;

        } else if (!is_null($data)) {
            $this->_nameEn = (string) $data;

        } else {
            $this->_nameEn = $data;
        }
        return $this;
    }

    /**
     * Gets column name_en
     *
     * @return string
     */
    public function getNameEn()
    {
        return $this->_nameEn;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function setNameEs($data)
    {

        if ($this->_nameEs != $data) {
            $this->_logChange('nameEs', $this->_nameEs, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_nameEs = $data;

        } else if (!is_null($data)) {
            $this->_nameEs = (string) $data;

        } else {
            $this->_nameEs = $data;
        }
        return $this;
    }

    /**
     * Gets column name_es
     *
     * @return string
     */
    public function getNameEs()
    {
        return $this->_nameEs;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function setZone($data, $language = '')
    {

        $language = $this->_getCurrentLanguage($language);

        $methodName = "setZone". ucfirst(str_replace('_', '', $language));
        if (!method_exists($this, $methodName)) {

            // new \Exception('Unavailable language');
            $this->_zone = $data;
            return $this;
        }
        $this->$methodName($data);
        return $this;
    }

    /**
     * Gets column zone
     *
     * @return string
     */
    public function getZone($language = '')
    {
        $language = $this->_getCurrentLanguage($language);

        $methodName = "getZone". ucfirst(str_replace('_', '', $language));
        if (!method_exists($this, $methodName)) {

            // new \Exception('Unavailable language');
            return $this->_zone;
        }

        return $this->$methodName();
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function setZoneEn($data)
    {

        if ($this->_zoneEn != $data) {
            $this->_logChange('zoneEn', $this->_zoneEn, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_zoneEn = $data;

        } else if (!is_null($data)) {
            $this->_zoneEn = (string) $data;

        } else {
            $this->_zoneEn = $data;
        }
        return $this;
    }

    /**
     * Gets column zone_en
     *
     * @return string
     */
    public function getZoneEn()
    {
        return $this->_zoneEn;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function setZoneEs($data)
    {

        if ($this->_zoneEs != $data) {
            $this->_logChange('zoneEs', $this->_zoneEs, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_zoneEs = $data;

        } else if (!is_null($data)) {
            $this->_zoneEs = (string) $data;

        } else {
            $this->_zoneEs = $data;
        }
        return $this;
    }

    /**
     * Gets column zone_es
     *
     * @return string
     */
    public function getZoneEs()
    {
        return $this->_zoneEs;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function setCallingCode($data)
    {

        if ($this->_callingCode != $data) {
            $this->_logChange('callingCode', $this->_callingCode, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_callingCode = $data;

        } else if (!is_null($data)) {
            $this->_callingCode = (int) $data;

        } else {
            $this->_callingCode = $data;
        }
        return $this;
    }

    /**
     * Gets column calling_code
     *
     * @return int
     */
    public function getCallingCode()
    {
        return $this->_callingCode;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function setIntCode($data)
    {

        if ($this->_intCode != $data) {
            $this->_logChange('intCode', $this->_intCode, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_intCode = $data;

        } else if (!is_null($data)) {
            $this->_intCode = (string) $data;

        } else {
            $this->_intCode = $data;
        }
        return $this;
    }

    /**
     * Gets column intCode
     *
     * @return string
     */
    public function getIntCode()
    {
        return $this->_intCode;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function setE164Pattern($data)
    {

        if ($this->_e164Pattern != $data) {
            $this->_logChange('e164Pattern', $this->_e164Pattern, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_e164Pattern = $data;

        } else if (!is_null($data)) {
            $this->_e164Pattern = (string) $data;

        } else {
            $this->_e164Pattern = $data;
        }
        return $this;
    }

    /**
     * Gets column e164Pattern
     *
     * @return string
     */
    public function getE164Pattern()
    {
        return $this->_e164Pattern;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function setNationalCC($data)
    {

        if ($this->_nationalCC != $data) {
            $this->_logChange('nationalCC', $this->_nationalCC, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_nationalCC = $data;

        } else if (!is_null($data)) {
            $this->_nationalCC = (int) $data;

        } else {
            $this->_nationalCC = $data;
        }
        return $this;
    }

    /**
     * Gets column nationalCC
     *
     * @return int
     */
    public function getNationalCC()
    {
        return $this->_nationalCC;
    }

    /**
     * Sets dependent relations Companies_ibfk_9
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Companies
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function setCompanies(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Companies === null) {

                $this->getCompanies();
            }

            $oldRelations = $this->_Companies;

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

        $this->_Companies = array();

        foreach ($data as $object) {
            $this->addCompanies($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Companies_ibfk_9
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function addCompanies(\IvozProvider\Model\Raw\Companies $data)
    {
        $this->_Companies[] = $data;
        $this->_setLoaded('CompaniesIbfk9');
        return $this;
    }

    /**
     * Gets dependent Companies_ibfk_9
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Companies
     */
    public function getCompanies($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CompaniesIbfk9';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Companies = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Companies;
    }

    /**
     * Sets dependent relations DDIs_ibfk_9
     *
     * @param array $data An array of \IvozProvider\Model\Raw\DDIs
     * @return \IvozProvider\Model\Raw\Countries
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
     * Sets dependent relations DDIs_ibfk_9
     *
     * @param \IvozProvider\Model\Raw\DDIs $data
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function addDDIs(\IvozProvider\Model\Raw\DDIs $data)
    {
        $this->_DDIs[] = $data;
        $this->_setLoaded('DDIsIbfk9');
        return $this;
    }

    /**
     * Gets dependent DDIs_ibfk_9
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\DDIs
     */
    public function getDDIs($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk9';

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
     * Sets dependent relations Friends_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Friends
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function setFriends(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Friends === null) {

                $this->getFriends();
            }

            $oldRelations = $this->_Friends;

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

        $this->_Friends = array();

        foreach ($data as $object) {
            $this->addFriends($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Friends_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\Friends $data
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function addFriends(\IvozProvider\Model\Raw\Friends $data)
    {
        $this->_Friends[] = $data;
        $this->_setLoaded('FriendsIbfk2');
        return $this;
    }

    /**
     * Gets dependent Friends_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Friends
     */
    public function getFriends($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FriendsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Friends = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Friends;
    }

    /**
     * Sets dependent relations MatchListPatterns_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\MatchListPatterns
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function setMatchListPatterns(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_MatchListPatterns === null) {

                $this->getMatchListPatterns();
            }

            $oldRelations = $this->_MatchListPatterns;

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

        $this->_MatchListPatterns = array();

        foreach ($data as $object) {
            $this->addMatchListPatterns($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations MatchListPatterns_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\MatchListPatterns $data
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function addMatchListPatterns(\IvozProvider\Model\Raw\MatchListPatterns $data)
    {
        $this->_MatchListPatterns[] = $data;
        $this->_setLoaded('MatchListPatternsIbfk2');
        return $this;
    }

    /**
     * Gets dependent MatchListPatterns_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\MatchListPatterns
     */
    public function getMatchListPatterns($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'MatchListPatternsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_MatchListPatterns = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_MatchListPatterns;
    }

    /**
     * Sets dependent relations RetailAccounts_ibfk_3
     *
     * @param array $data An array of \IvozProvider\Model\Raw\RetailAccounts
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function setRetailAccounts(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_RetailAccounts === null) {

                $this->getRetailAccounts();
            }

            $oldRelations = $this->_RetailAccounts;

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

        $this->_RetailAccounts = array();

        foreach ($data as $object) {
            $this->addRetailAccounts($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations RetailAccounts_ibfk_3
     *
     * @param \IvozProvider\Model\Raw\RetailAccounts $data
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function addRetailAccounts(\IvozProvider\Model\Raw\RetailAccounts $data)
    {
        $this->_RetailAccounts[] = $data;
        $this->_setLoaded('RetailAccountsIbfk3');
        return $this;
    }

    /**
     * Gets dependent RetailAccounts_ibfk_3
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\RetailAccounts
     */
    public function getRetailAccounts($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'RetailAccountsIbfk3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_RetailAccounts = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_RetailAccounts;
    }

    /**
     * Sets dependent relations Timezones_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Timezones
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function setTimezones(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Timezones === null) {

                $this->getTimezones();
            }

            $oldRelations = $this->_Timezones;

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

        $this->_Timezones = array();

        foreach ($data as $object) {
            $this->addTimezones($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Timezones_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\Timezones $data
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function addTimezones(\IvozProvider\Model\Raw\Timezones $data)
    {
        $this->_Timezones[] = $data;
        $this->_setLoaded('TimezonesIbfk2');
        return $this;
    }

    /**
     * Gets dependent Timezones_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Timezones
     */
    public function getTimezones($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'TimezonesIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Timezones = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Timezones;
    }

    /**
     * Sets dependent relations TransformationRulesetGroupsTrunks_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function setTransformationRulesetGroupsTrunks(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_TransformationRulesetGroupsTrunks === null) {

                $this->getTransformationRulesetGroupsTrunks();
            }

            $oldRelations = $this->_TransformationRulesetGroupsTrunks;

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

        $this->_TransformationRulesetGroupsTrunks = array();

        foreach ($data as $object) {
            $this->addTransformationRulesetGroupsTrunks($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations TransformationRulesetGroupsTrunks_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks $data
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function addTransformationRulesetGroupsTrunks(\IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks $data)
    {
        $this->_TransformationRulesetGroupsTrunks[] = $data;
        $this->_setLoaded('TransformationRulesetGroupsTrunksIbfk2');
        return $this;
    }

    /**
     * Gets dependent TransformationRulesetGroupsTrunks_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\TransformationRulesetGroupsTrunks
     */
    public function getTransformationRulesetGroupsTrunks($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'TransformationRulesetGroupsTrunksIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_TransformationRulesetGroupsTrunks = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_TransformationRulesetGroupsTrunks;
    }

    /**
     * Sets dependent relations Users_ibfk_12
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Users
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function setUsers(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Users === null) {

                $this->getUsers();
            }

            $oldRelations = $this->_Users;

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

        $this->_Users = array();

        foreach ($data as $object) {
            $this->addUsers($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Users_ibfk_12
     *
     * @param \IvozProvider\Model\Raw\Users $data
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function addUsers(\IvozProvider\Model\Raw\Users $data)
    {
        $this->_Users[] = $data;
        $this->_setLoaded('UsersIbfk12');
        return $this;
    }

    /**
     * Gets dependent Users_ibfk_12
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Users
     */
    public function getUsers($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'UsersIbfk12';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Users = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Users;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\Countries
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\Countries')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\Countries);

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
     * @return null | \IvozProvider\Model\Validator\Countries
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\Countries')) {

                $this->setValidator(new \IvozProvider\Validator\Countries);
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
     * @see \Mapper\Sql\Countries::delete
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