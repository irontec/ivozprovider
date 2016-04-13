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
class Timezones extends ModelAbstract
{


    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_id;

    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_countryId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_tz;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_comment;

    /**
     * [ml]
     * Database var type varchar
     *
     * @var string
     */
    protected $_timeZoneLabel;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_timeZoneLabelEn;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_timeZoneLabelEs;


    /**
     * Parent relation Timezones_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\Countries
     */
    protected $_Country;


    /**
     * Dependent relation BrandOperators_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\BrandOperators[]
     */
    protected $_BrandOperators;

    /**
     * Dependent relation Brands_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Brands[]
     */
    protected $_Brands;

    /**
     * Dependent relation Companies_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Companies[]
     */
    protected $_Companies;

    /**
     * Dependent relation MainOperators_ibfk_1
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\MainOperators[]
     */
    protected $_MainOperators;

    /**
     * Dependent relation Users_ibfk_8
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\Users[]
     */
    protected $_Users;

    protected $_columnsList = array(
        'id'=>'id',
        'countryId'=>'countryId',
        'tz'=>'tz',
        'comment'=>'comment',
        'timeZoneLabel'=>'timeZoneLabel',
        'timeZoneLabel_en'=>'timeZoneLabelEn',
        'timeZoneLabel_es'=>'timeZoneLabelEs',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'timeZoneLabel'=> array('ml'),
        ));

        $this->setMultiLangColumnsList(array(
            'timeZoneLabel'=>'TimeZoneLabel',
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'TimezonesIbfk2'=> array(
                    'property' => 'Country',
                    'table_name' => 'Countries',
                ),
        ));

        $this->setDependentList(array(
            'BrandOperatorsIbfk2' => array(
                    'property' => 'BrandOperators',
                    'table_name' => 'BrandOperators',
                ),
            'BrandsIbfk1' => array(
                    'property' => 'Brands',
                    'table_name' => 'Brands',
                ),
            'CompaniesIbfk2' => array(
                    'property' => 'Companies',
                    'table_name' => 'Companies',
                ),
            'MainOperatorsIbfk1' => array(
                    'property' => 'MainOperators',
                    'table_name' => 'MainOperators',
                ),
            'UsersIbfk8' => array(
                    'property' => 'Users',
                    'table_name' => 'Users',
                ),
        ));

        $this->setOnDeleteCascadeRelationships(array(
            'BrandOperators_ibfk_2',
            'Brands_ibfk_1',
            'Companies_ibfk_2',
            'MainOperators_ibfk_1'
        ));



        $this->_defaultValues = array(
            'timeZoneLabel' => '',
            'timeZoneLabelEn' => '',
            'timeZoneLabelEs' => '',
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
     * @return \IvozProvider\Model\Raw\Timezones
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
     * @return \IvozProvider\Model\Raw\Timezones
     */
    public function setCountryId($data)
    {

        if ($this->_countryId != $data) {
            $this->_logChange('countryId');
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
     * @return \IvozProvider\Model\Raw\Timezones
     */
    public function setTz($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_tz != $data) {
            $this->_logChange('tz');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_tz = $data;

        } else if (!is_null($data)) {
            $this->_tz = (string) $data;

        } else {
            $this->_tz = $data;
        }
        return $this;
    }

    /**
     * Gets column tz
     *
     * @return string
     */
    public function getTz()
    {
        return $this->_tz;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Timezones
     */
    public function setComment($data)
    {

        if ($this->_comment != $data) {
            $this->_logChange('comment');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_comment = $data;

        } else if (!is_null($data)) {
            $this->_comment = (string) $data;

        } else {
            $this->_comment = $data;
        }
        return $this;
    }

    /**
     * Gets column comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->_comment;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Timezones
     */
    public function setTimeZoneLabel($data, $language = '')
    {

        $language = $this->_getCurrentLanguage($language);

        $methodName = "setTimeZoneLabel". ucfirst(str_replace('_', '', $language));
        if (!method_exists($this, $methodName)) {

            // new \Exception('Unavailable language');
            $this->_timeZoneLabel = $data;
            return $this;
        }
        $this->$methodName($data);
        return $this;
    }

    /**
     * Gets column timeZoneLabel
     *
     * @return string
     */
    public function getTimeZoneLabel($language = '')
    {
        $language = $this->_getCurrentLanguage($language);

        $methodName = "getTimeZoneLabel". ucfirst(str_replace('_', '', $language));
        if (!method_exists($this, $methodName)) {

            // new \Exception('Unavailable language');
            return $this->_timeZoneLabel;
        }

        return $this->$methodName();
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Timezones
     */
    public function setTimeZoneLabelEn($data)
    {

        if ($this->_timeZoneLabelEn != $data) {
            $this->_logChange('timeZoneLabelEn');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_timeZoneLabelEn = $data;

        } else if (!is_null($data)) {
            $this->_timeZoneLabelEn = (string) $data;

        } else {
            $this->_timeZoneLabelEn = $data;
        }
        return $this;
    }

    /**
     * Gets column timeZoneLabel_en
     *
     * @return string
     */
    public function getTimeZoneLabelEn()
    {
        return $this->_timeZoneLabelEn;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Timezones
     */
    public function setTimeZoneLabelEs($data)
    {

        if ($this->_timeZoneLabelEs != $data) {
            $this->_logChange('timeZoneLabelEs');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_timeZoneLabelEs = $data;

        } else if (!is_null($data)) {
            $this->_timeZoneLabelEs = (string) $data;

        } else {
            $this->_timeZoneLabelEs = $data;
        }
        return $this;
    }

    /**
     * Gets column timeZoneLabel_es
     *
     * @return string
     */
    public function getTimeZoneLabelEs()
    {
        return $this->_timeZoneLabelEs;
    }

    /**
     * Sets parent relation Country
     *
     * @param \IvozProvider\Model\Raw\Countries $data
     * @return \IvozProvider\Model\Raw\Timezones
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

        $this->_setLoaded('TimezonesIbfk2');
        return $this;
    }

    /**
     * Gets parent Country
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Countries
     */
    public function getCountry($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'TimezonesIbfk2';

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
     * Sets dependent relations BrandOperators_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\BrandOperators
     * @return \IvozProvider\Model\Raw\Timezones
     */
    public function setBrandOperators(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_BrandOperators === null) {

                $this->getBrandOperators();
            }

            $oldRelations = $this->_BrandOperators;

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

        $this->_BrandOperators = array();

        foreach ($data as $object) {
            $this->addBrandOperators($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations BrandOperators_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\BrandOperators $data
     * @return \IvozProvider\Model\Raw\Timezones
     */
    public function addBrandOperators(\IvozProvider\Model\Raw\BrandOperators $data)
    {
        $this->_BrandOperators[] = $data;
        $this->_setLoaded('BrandOperatorsIbfk2');
        return $this;
    }

    /**
     * Gets dependent BrandOperators_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\BrandOperators
     */
    public function getBrandOperators($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'BrandOperatorsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_BrandOperators = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_BrandOperators;
    }

    /**
     * Sets dependent relations Brands_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Brands
     * @return \IvozProvider\Model\Raw\Timezones
     */
    public function setBrands(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_Brands === null) {

                $this->getBrands();
            }

            $oldRelations = $this->_Brands;

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

        $this->_Brands = array();

        foreach ($data as $object) {
            $this->addBrands($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations Brands_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\Brands $data
     * @return \IvozProvider\Model\Raw\Timezones
     */
    public function addBrands(\IvozProvider\Model\Raw\Brands $data)
    {
        $this->_Brands[] = $data;
        $this->_setLoaded('BrandsIbfk1');
        return $this;
    }

    /**
     * Gets dependent Brands_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Brands
     */
    public function getBrands($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'BrandsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_Brands = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_Brands;
    }

    /**
     * Sets dependent relations Companies_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Companies
     * @return \IvozProvider\Model\Raw\Timezones
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
     * Sets dependent relations Companies_ibfk_2
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\Timezones
     */
    public function addCompanies(\IvozProvider\Model\Raw\Companies $data)
    {
        $this->_Companies[] = $data;
        $this->_setLoaded('CompaniesIbfk2');
        return $this;
    }

    /**
     * Gets dependent Companies_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Companies
     */
    public function getCompanies($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CompaniesIbfk2';

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
     * Sets dependent relations MainOperators_ibfk_1
     *
     * @param array $data An array of \IvozProvider\Model\Raw\MainOperators
     * @return \IvozProvider\Model\Raw\Timezones
     */
    public function setMainOperators(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_MainOperators === null) {

                $this->getMainOperators();
            }

            $oldRelations = $this->_MainOperators;

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

        $this->_MainOperators = array();

        foreach ($data as $object) {
            $this->addMainOperators($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations MainOperators_ibfk_1
     *
     * @param \IvozProvider\Model\Raw\MainOperators $data
     * @return \IvozProvider\Model\Raw\Timezones
     */
    public function addMainOperators(\IvozProvider\Model\Raw\MainOperators $data)
    {
        $this->_MainOperators[] = $data;
        $this->_setLoaded('MainOperatorsIbfk1');
        return $this;
    }

    /**
     * Gets dependent MainOperators_ibfk_1
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\MainOperators
     */
    public function getMainOperators($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'MainOperatorsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_MainOperators = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_MainOperators;
    }

    /**
     * Sets dependent relations Users_ibfk_8
     *
     * @param array $data An array of \IvozProvider\Model\Raw\Users
     * @return \IvozProvider\Model\Raw\Timezones
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
     * Sets dependent relations Users_ibfk_8
     *
     * @param \IvozProvider\Model\Raw\Users $data
     * @return \IvozProvider\Model\Raw\Timezones
     */
    public function addUsers(\IvozProvider\Model\Raw\Users $data)
    {
        $this->_Users[] = $data;
        $this->_setLoaded('UsersIbfk8');
        return $this;
    }

    /**
     * Gets dependent Users_ibfk_8
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\Users
     */
    public function getUsers($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'UsersIbfk8';

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
     * @return IvozProvider\Mapper\Sql\Timezones
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\Timezones')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\Timezones);

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
     * @return null | \IvozProvider\Model\Validator\Timezones
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\Timezones')) {

                $this->setValidator(new \IvozProvider\Validator\Timezones);
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
     * @see \Mapper\Sql\Timezones::delete
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