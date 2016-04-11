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
class Faxes extends ModelAbstract
{


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
     * Database var type varchar
     *
     * @var string
     */
    protected $_email;

    /**
     * Database var type tinyint
     *
     * @var int
     */
    protected $_sendByEmail;

    /**
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_outgoingDDI;


    /**
     * Parent relation Faxes_ibfk_2
     *
     * @var \Oasis\Model\Raw\DDIs
     */
    protected $_DDIs;

    /**
     * Parent relation Faxes_ibfk_1
     *
     * @var \Oasis\Model\Raw\Companies
     */
    protected $_Company;


    /**
     * Dependent relation DDIs_ibfk_7
     * Type: One-to-Many relationship
     *
     * @var \Oasis\Model\Raw\DDIs[]
     */
    protected $_DDIsByFax;

    /**
     * Dependent relation FaxesInOut_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \Oasis\Model\Raw\FaxesInOut[]
     */
    protected $_FaxesInOut;

    protected $_columnsList = array(
        'id'=>'id',
        'companyId'=>'companyId',
        'name'=>'name',
        'email'=>'email',
        'sendByEmail'=>'sendByEmail',
        'outgoingDDI'=>'outgoingDDI',
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
            'FaxesIbfk2'=> array(
                    'property' => 'DDIs',
                    'table_name' => 'DDIs',
                ),
            'FaxesIbfk1'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
        ));

        $this->setDependentList(array(
            'DDIsIbfk7' => array(
                    'property' => 'DDIsByFax',
                    'table_name' => 'DDIs',
                ),
            'FaxesInOutIbfk2' => array(
                    'property' => 'FaxesInOut',
                    'table_name' => 'FaxesInOut',
                ),
        ));


        $this->setOnDeleteSetNullRelationships(array(
            'DDIs_ibfk_7'
        ));


        $this->_defaultValues = array(
            'sendByEmail' => '1',
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
     * @return \Oasis\Model\Raw\Faxes
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
     * @return \Oasis\Model\Raw\Faxes
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
     * @return \Oasis\Model\Raw\Faxes
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
     * @param string $data
     * @return \Oasis\Model\Raw\Faxes
     */
    public function setEmail($data)
    {

        if ($this->_email != $data) {
            $this->_logChange('email');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_email = $data;

        } else if (!is_null($data)) {
            $this->_email = (string) $data;

        } else {
            $this->_email = $data;
        }
        return $this;
    }

    /**
     * Gets column email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\Faxes
     */
    public function setSendByEmail($data)
    {

        if ($this->_sendByEmail != $data) {
            $this->_logChange('sendByEmail');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_sendByEmail = $data;

        } else if (!is_null($data)) {
            $this->_sendByEmail = (int) $data;

        } else {
            $this->_sendByEmail = $data;
        }
        return $this;
    }

    /**
     * Gets column sendByEmail
     *
     * @return int
     */
    public function getSendByEmail()
    {
        return $this->_sendByEmail;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param binary $data
     * @return \Oasis\Model\Raw\Faxes
     */
    public function setOutgoingDDI($data)
    {

        if ($this->_outgoingDDI != $data) {
            $this->_logChange('outgoingDDI');
        }

        $this->_outgoingDDI = $data;
        return $this;
    }

    /**
     * Gets column outgoingDDI
     *
     * @return binary
     */
    public function getOutgoingDDI()
    {
        return $this->_outgoingDDI;
    }

    /**
     * Sets parent relation OutgoingDDI
     *
     * @param \Oasis\Model\Raw\DDIs $data
     * @return \Oasis\Model\Raw\Faxes
     */
    public function setDDIs(\Oasis\Model\Raw\DDIs $data)
    {
        $this->_DDIs = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setOutgoingDDI($primaryKey);
        }

        $this->_setLoaded('FaxesIbfk2');
        return $this;
    }

    /**
     * Gets parent OutgoingDDI
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Oasis\Model\Raw\DDIs
     */
    public function getDDIs($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FaxesIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_DDIs = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_DDIs;
    }

    /**
     * Sets parent relation Company
     *
     * @param \Oasis\Model\Raw\Companies $data
     * @return \Oasis\Model\Raw\Faxes
     */
    public function setCompany(\Oasis\Model\Raw\Companies $data)
    {
        $this->_Company = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setCompanyId($primaryKey);
        }

        $this->_setLoaded('FaxesIbfk1');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Oasis\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FaxesIbfk1';

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
     * Sets dependent relations DDIs_ibfk_7
     *
     * @param array $data An array of \Oasis\Model\Raw\DDIs
     * @return \Oasis\Model\Raw\Faxes
     */
    public function setDDIsByFax(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_DDIsByFax === null) {

                $this->getDDIsByFax();
            }

            $oldRelations = $this->_DDIsByFax;

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

        $this->_DDIsByFax = array();

        foreach ($data as $object) {
            $this->addDDIsByFax($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations DDIs_ibfk_7
     *
     * @param \Oasis\Model\Raw\DDIs $data
     * @return \Oasis\Model\Raw\Faxes
     */
    public function addDDIsByFax(\Oasis\Model\Raw\DDIs $data)
    {
        $this->_DDIsByFax[] = $data;
        $this->_setLoaded('DDIsIbfk7');
        return $this;
    }

    /**
     * Gets dependent DDIs_ibfk_7
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Oasis\Model\Raw\DDIs
     */
    public function getDDIsByFax($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'DDIsIbfk7';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_DDIsByFax = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_DDIsByFax;
    }

    /**
     * Sets dependent relations FaxesInOut_ibfk_2
     *
     * @param array $data An array of \Oasis\Model\Raw\FaxesInOut
     * @return \Oasis\Model\Raw\Faxes
     */
    public function setFaxesInOut(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_FaxesInOut === null) {

                $this->getFaxesInOut();
            }

            $oldRelations = $this->_FaxesInOut;

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

        $this->_FaxesInOut = array();

        foreach ($data as $object) {
            $this->addFaxesInOut($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations FaxesInOut_ibfk_2
     *
     * @param \Oasis\Model\Raw\FaxesInOut $data
     * @return \Oasis\Model\Raw\Faxes
     */
    public function addFaxesInOut(\Oasis\Model\Raw\FaxesInOut $data)
    {
        $this->_FaxesInOut[] = $data;
        $this->_setLoaded('FaxesInOutIbfk2');
        return $this;
    }

    /**
     * Gets dependent FaxesInOut_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Oasis\Model\Raw\FaxesInOut
     */
    public function getFaxesInOut($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FaxesInOutIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_FaxesInOut = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_FaxesInOut;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\Faxes
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\Faxes')) {

                $this->setMapper(new \Oasis\Mapper\Sql\Faxes);

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
     * @return null | \Oasis\Model\Validator\Faxes
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\Faxes')) {

                $this->setValidator(new \Oasis\Validator\Faxes);
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
     * @see \Mapper\Sql\Faxes::delete
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