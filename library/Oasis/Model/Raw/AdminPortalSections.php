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
class AdminPortalSections extends ModelAbstract
{


    /**
     * [uuid:php]
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_id;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_name;



    /**
     * Dependent relation CompanyAdminsRelAdminPortalSection_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \Oasis\Model\Raw\CompanyAdminsRelAdminPortalSections[]
     */
    protected $_CompanyAdminsRelAdminPortalSections;


    protected $_columnsList = array(
        'id'=>'id',
        'name'=>'name',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'id'=> array('uuid:php'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
        ));

        $this->setDependentList(array(
            'CompanyAdminsRelAdminPortalSectionIbfk2' => array(
                    'property' => 'CompanyAdminsRelAdminPortalSections',
                    'table_name' => 'CompanyAdminsRelAdminPortalSections',
                ),
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
     * @return \Oasis\Model\Raw\AdminPortalSections
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
     * @param string $data
     * @return \Oasis\Model\Raw\AdminPortalSections
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
     * Sets dependent relations CompanyAdminsRelAdminPortalSection_ibfk_2
     *
     * @param array $data An array of \Oasis\Model\Raw\CompanyAdminsRelAdminPortalSections
     * @return \Oasis\Model\Raw\AdminPortalSections
     */
    public function setCompanyAdminsRelAdminPortalSections(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_CompanyAdminsRelAdminPortalSections === null) {

                $this->getCompanyAdminsRelAdminPortalSections();
            }

            $oldRelations = $this->_CompanyAdminsRelAdminPortalSections;

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

        $this->_CompanyAdminsRelAdminPortalSections = array();

        foreach ($data as $object) {
            $this->addCompanyAdminsRelAdminPortalSections($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations CompanyAdminsRelAdminPortalSection_ibfk_2
     *
     * @param \Oasis\Model\Raw\CompanyAdminsRelAdminPortalSections $data
     * @return \Oasis\Model\Raw\AdminPortalSections
     */
    public function addCompanyAdminsRelAdminPortalSections(\Oasis\Model\Raw\CompanyAdminsRelAdminPortalSections $data)
    {
        $this->_CompanyAdminsRelAdminPortalSections[] = $data;
        $this->_setLoaded('CompanyAdminsRelAdminPortalSectionIbfk2');
        return $this;
    }

    /**
     * Gets dependent CompanyAdminsRelAdminPortalSection_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Oasis\Model\Raw\CompanyAdminsRelAdminPortalSections
     */
    public function getCompanyAdminsRelAdminPortalSections($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'CompanyAdminsRelAdminPortalSectionIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_CompanyAdminsRelAdminPortalSections = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_CompanyAdminsRelAdminPortalSections;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\AdminPortalSections
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\AdminPortalSections')) {

                $this->setMapper(new \Oasis\Mapper\Sql\AdminPortalSections);

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
     * @return null | \Oasis\Model\Validator\AdminPortalSections
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\AdminPortalSections')) {

                $this->setValidator(new \Oasis\Validator\AdminPortalSections);
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
     * @see \Mapper\Sql\AdminPortalSections::delete
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
