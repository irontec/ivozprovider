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
 * [entity]
 *
 * @package Oasis\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace Oasis\Model\Raw;
class CompanyAdminsRelAdminPortalSections extends ModelAbstract
{

    protected $_accessPrivilegesAcceptedValues = array(
        'full',
        'read-only',
        'no-access',
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
    protected $_companyAdminId;

    /**
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_adminPortalSectionId;

    /**
     * [enum:full|read-only|no-access]
     * Database var type varchar
     *
     * @var string
     */
    protected $_accessPrivileges;


    /**
     * Parent relation CompanyAdminsRelAdminPortalSection_ibfk_1
     *
     * @var \Oasis\Model\Raw\CompanyAdmins
     */
    protected $_CompanyAdmin;

    /**
     * Parent relation CompanyAdminsRelAdminPortalSection_ibfk_2
     *
     * @var \Oasis\Model\Raw\AdminPortalSections
     */
    protected $_AdminPortalSection;



    protected $_columnsList = array(
        'id'=>'id',
        'companyAdminId'=>'companyAdminId',
        'adminPortalSectionId'=>'adminPortalSectionId',
        'accessPrivileges'=>'accessPrivileges',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'id'=> array('uuid:php'),
            'accessPrivileges'=> array('enum:full|read-only|no-access'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'CompanyAdminsRelAdminPortalSectionIbfk1'=> array(
                    'property' => 'CompanyAdmin',
                    'table_name' => 'CompanyAdmins',
                ),
            'CompanyAdminsRelAdminPortalSectionIbfk2'=> array(
                    'property' => 'AdminPortalSection',
                    'table_name' => 'AdminPortalSections',
                ),
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
     * @param binary $data
     * @return \Oasis\Model\Raw\CompanyAdminsRelAdminPortalSections
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
     * @return \Oasis\Model\Raw\CompanyAdminsRelAdminPortalSections
     */
    public function setCompanyAdminId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }

        if ($this->_companyAdminId != $data) {
            $this->_logChange('companyAdminId');
        }


        $this->_companyAdminId = $data;
        return $this;
    }

    /**
     * Gets column companyAdminId
     *
     * @return binary
     */
    public function getCompanyAdminId()
    {
            return $this->_companyAdminId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param binary $data
     * @return \Oasis\Model\Raw\CompanyAdminsRelAdminPortalSections
     */
    public function setAdminPortalSectionId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }

        if ($this->_adminPortalSectionId != $data) {
            $this->_logChange('adminPortalSectionId');
        }


        $this->_adminPortalSectionId = $data;
        return $this;
    }

    /**
     * Gets column adminPortalSectionId
     *
     * @return binary
     */
    public function getAdminPortalSectionId()
    {
            return $this->_adminPortalSectionId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\CompanyAdminsRelAdminPortalSections
     */
    public function setAccessPrivileges($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }

        if ($this->_accessPrivileges != $data) {
            $this->_logChange('accessPrivileges');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_accessPrivileges = $data;
        } else if (!is_null($data)) {
            if (!in_array($data, $this->_accessPrivilegesAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for accessPrivileges'));
            }
            $this->_accessPrivileges = (string) $data;
        } else {
            $this->_accessPrivileges = $data;
        }
        return $this;
    }

    /**
     * Gets column accessPrivileges
     *
     * @return string
     */
    public function getAccessPrivileges()
    {
            return $this->_accessPrivileges;
    }


    /**
     * Sets parent relation CompanyAdmin
     *
     * @param \Oasis\Model\Raw\CompanyAdmins $data
     * @return \Oasis\Model\Raw\CompanyAdminsRelAdminPortalSections
     */
    public function setCompanyAdmin(\Oasis\Model\Raw\CompanyAdmins $data)
    {
        $this->_CompanyAdmin = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setCompanyAdminId($primaryKey);
        }

        $this->_setLoaded('CompanyAdminsRelAdminPortalSectionIbfk1');
        return $this;
    }

    /**
     * Gets parent CompanyAdmin
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Oasis\Model\Raw\CompanyAdmins
     */
    public function getCompanyAdmin($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CompanyAdminsRelAdminPortalSectionIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_CompanyAdmin = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_CompanyAdmin;
    }

    /**
     * Sets parent relation AdminPortalSection
     *
     * @param \Oasis\Model\Raw\AdminPortalSections $data
     * @return \Oasis\Model\Raw\CompanyAdminsRelAdminPortalSections
     */
    public function setAdminPortalSection(\Oasis\Model\Raw\AdminPortalSections $data)
    {
        $this->_AdminPortalSection = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setAdminPortalSectionId($primaryKey);
        }

        $this->_setLoaded('CompanyAdminsRelAdminPortalSectionIbfk2');
        return $this;
    }

    /**
     * Gets parent AdminPortalSection
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Oasis\Model\Raw\AdminPortalSections
     */
    public function getAdminPortalSection($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CompanyAdminsRelAdminPortalSectionIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_AdminPortalSection = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_AdminPortalSection;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\CompanyAdminsRelAdminPortalSections
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\CompanyAdminsRelAdminPortalSections')) {

                $this->setMapper(new \Oasis\Mapper\Sql\CompanyAdminsRelAdminPortalSections);

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
     * @return null | \Oasis\Model\Validator\CompanyAdminsRelAdminPortalSections
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\CompanyAdminsRelAdminPortalSections')) {

                $this->setValidator(new \Oasis\Validator\CompanyAdminsRelAdminPortalSections);
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
     * @see \Mapper\Sql\CompanyAdminsRelAdminPortalSections::delete
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
}
