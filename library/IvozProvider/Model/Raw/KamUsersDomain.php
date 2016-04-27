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
class KamUsersDomain extends ModelAbstract
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
    protected $_domain;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_did;

    /**
     * Database var type datetime
     *
     * @var string
     */
    protected $_lastModified;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_domainId;


    /**
     * Parent relation kam_users_domain_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Domains
     */
    protected $_Domains;


    protected $_columnsList = array(
        'id'=>'id',
        'domain'=>'domain',
        'did'=>'did',
        'last_modified'=>'lastModified',
        'domainId'=>'domainId',
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
            'KamUsersDomainIbfk1'=> array(
                    'property' => 'Domains',
                    'table_name' => 'Domains',
                ),
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
            'lastModified' => '1900-01-01 00:00:01',
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
     * @return \IvozProvider\Model\Raw\KamUsersDomain
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamUsersDomain
     */
    public function setDomain($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_domain != $data) {
            $this->_logChange('domain');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_domain = $data;

        } else if (!is_null($data)) {
            $this->_domain = (string) $data;

        } else {
            $this->_domain = $data;
        }
        return $this;
    }

    /**
     * Gets column domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->_domain;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamUsersDomain
     */
    public function setDid($data)
    {

        if ($this->_did != $data) {
            $this->_logChange('did');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_did = $data;

        } else if (!is_null($data)) {
            $this->_did = (string) $data;

        } else {
            $this->_did = $data;
        }
        return $this;
    }

    /**
     * Gets column did
     *
     * @return string
     */
    public function getDid()
    {
        return $this->_did;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \IvozProvider\Model\Raw\KamUsersDomain
     */
    public function setLastModified($data)
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

        if ($this->_lastModified != $data) {
            $this->_logChange('lastModified');
        }

        $this->_lastModified = $data;
        return $this;
    }

    /**
     * Gets column last_modified
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getLastModified($returnZendDate = false)
    {
        if (is_null($this->_lastModified)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_lastModified->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_lastModified->format('Y-m-d H:i:s');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\KamUsersDomain
     */
    public function setDomainId($data)
    {

        if ($this->_domainId != $data) {
            $this->_logChange('domainId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_domainId = $data;

        } else if (!is_null($data)) {
            $this->_domainId = (int) $data;

        } else {
            $this->_domainId = $data;
        }
        return $this;
    }

    /**
     * Gets column domainId
     *
     * @return int
     */
    public function getDomainId()
    {
        return $this->_domainId;
    }

    /**
     * Sets parent relation Domain
     *
     * @param \IvozProvider\Model\Raw\Domains $data
     * @return \IvozProvider\Model\Raw\KamUsersDomain
     */
    public function setDomains(\IvozProvider\Model\Raw\Domains $data)
    {
        $this->_Domains = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setDomainId($primaryKey);
        }

        $this->_setLoaded('KamUsersDomainIbfk1');
        return $this;
    }

    /**
     * Gets parent Domain
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Domains
     */
    public function getDomains($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamUsersDomainIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Domains = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Domains;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\KamUsersDomain
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\KamUsersDomain')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\KamUsersDomain);

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
     * @return null | \IvozProvider\Model\Validator\KamUsersDomain
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\KamUsersDomain')) {

                $this->setValidator(new \IvozProvider\Validator\KamUsersDomain);
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
     * @see \Mapper\Sql\KamUsersDomain::delete
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