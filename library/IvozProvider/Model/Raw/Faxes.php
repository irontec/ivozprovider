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
class Faxes extends ModelAbstract
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
     * Database var type int
     *
     * @var int
     */
    protected $_outgoingDDIId;


    /**
     * Parent relation Faxes_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;

    /**
     * Parent relation Faxes_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\DDIs
     */
    protected $_OutgoingDDI;


    /**
     * Dependent relation DDIs_ibfk_7
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\DDIs[]
     */
    protected $_DDIs;

    /**
     * Dependent relation FaxesInOut_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\FaxesInOut[]
     */
    protected $_FaxesInOut;

    protected $_columnsList = array(
        'id'=>'id',
        'companyId'=>'companyId',
        'name'=>'name',
        'email'=>'email',
        'sendByEmail'=>'sendByEmail',
        'outgoingDDIId'=>'outgoingDDIId',
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
            'FaxesIbfk1'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
            'FaxesIbfk2'=> array(
                    'property' => 'OutgoingDDI',
                    'table_name' => 'DDIs',
                ),
        ));

        $this->setDependentList(array(
            'DDIsIbfk7' => array(
                    'property' => 'DDIs',
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\Faxes
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
     * @return \IvozProvider\Model\Raw\Faxes
     */
    public function setCompanyId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\Faxes
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
     * @return \IvozProvider\Model\Raw\Faxes
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
     * @return \IvozProvider\Model\Raw\Faxes
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\Faxes
     */
    public function setOutgoingDDIId($data)
    {

        if ($this->_outgoingDDIId != $data) {
            $this->_logChange('outgoingDDIId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_outgoingDDIId = $data;

        } else if (!is_null($data)) {
            $this->_outgoingDDIId = (int) $data;

        } else {
            $this->_outgoingDDIId = $data;
        }
        return $this;
    }

    /**
     * Gets column outgoingDDIId
     *
     * @return int
     */
    public function getOutgoingDDIId()
    {
        return $this->_outgoingDDIId;
    }

    /**
     * Sets parent relation Company
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\Faxes
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

        $this->_setLoaded('FaxesIbfk1');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
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
     * Sets parent relation OutgoingDDI
     *
     * @param \IvozProvider\Model\Raw\DDIs $data
     * @return \IvozProvider\Model\Raw\Faxes
     */
    public function setOutgoingDDI(\IvozProvider\Model\Raw\DDIs $data)
    {
        $this->_OutgoingDDI = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setOutgoingDDIId($primaryKey);
        }

        $this->_setLoaded('FaxesIbfk2');
        return $this;
    }

    /**
     * Gets parent OutgoingDDI
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\DDIs
     */
    public function getOutgoingDDI($where = null, $orderBy = null, $avoidLoading = false)
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
            $this->_OutgoingDDI = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_OutgoingDDI;
    }

    /**
     * Sets dependent relations DDIs_ibfk_7
     *
     * @param array $data An array of \IvozProvider\Model\Raw\DDIs
     * @return \IvozProvider\Model\Raw\Faxes
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
     * Sets dependent relations DDIs_ibfk_7
     *
     * @param \IvozProvider\Model\Raw\DDIs $data
     * @return \IvozProvider\Model\Raw\Faxes
     */
    public function addDDIs(\IvozProvider\Model\Raw\DDIs $data)
    {
        $this->_DDIs[] = $data;
        $this->_setLoaded('DDIsIbfk7');
        return $this;
    }

    /**
     * Gets dependent DDIs_ibfk_7
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\DDIs
     */
    public function getDDIs($where = null, $orderBy = null, $avoidLoading = false)
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
            $this->_DDIs = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_DDIs;
    }

    /**
     * Sets dependent relations FaxesInOut_ibfk_2
     *
     * @param array $data An array of \IvozProvider\Model\Raw\FaxesInOut
     * @return \IvozProvider\Model\Raw\Faxes
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
     * @param \IvozProvider\Model\Raw\FaxesInOut $data
     * @return \IvozProvider\Model\Raw\Faxes
     */
    public function addFaxesInOut(\IvozProvider\Model\Raw\FaxesInOut $data)
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
     * @return array The array of \IvozProvider\Model\Raw\FaxesInOut
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
     * @return IvozProvider\Mapper\Sql\Faxes
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\Faxes')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\Faxes);

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
     * @return null | \IvozProvider\Model\Validator\Faxes
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\Faxes')) {

                $this->setValidator(new \IvozProvider\Validator\Faxes);
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