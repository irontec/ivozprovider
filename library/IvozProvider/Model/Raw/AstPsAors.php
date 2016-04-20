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
class AstPsAors extends ModelAbstract
{

    protected $_removeExistingAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_authenticateQualifyAcceptedValues = array(
        'yes',
        'no',
    );
    protected $_supportPathAcceptedValues = array(
        'yes',
        'no',
    );

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_sorceryId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_terminalId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_proxyTrunkId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_defaultExpiration;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_maxContacts;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_minimumExpiration;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_removeExisting;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_authenticateQualify;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_maximumExpiration;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_supportPath;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_contact;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_qualifyFrequency;


    /**
     * Parent relation ast_ps_aors_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Terminals
     */
    protected $_Terminal;

    /**
     * Parent relation ast_ps_aors_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\ProxyTrunks
     */
    protected $_ProxyTrunk;


    protected $_columnsList = array(
        'sorcery_id'=>'sorceryId',
        'terminalId'=>'terminalId',
        'proxyTrunkId'=>'proxyTrunkId',
        'default_expiration'=>'defaultExpiration',
        'max_contacts'=>'maxContacts',
        'minimum_expiration'=>'minimumExpiration',
        'remove_existing'=>'removeExisting',
        'authenticate_qualify'=>'authenticateQualify',
        'maximum_expiration'=>'maximumExpiration',
        'support_path'=>'supportPath',
        'contact'=>'contact',
        'qualify_frequency'=>'qualifyFrequency',
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
            'AstPsAorsIbfk1'=> array(
                    'property' => 'Terminal',
                    'table_name' => 'Terminals',
                ),
            'AstPsAorsIbfk2'=> array(
                    'property' => 'ProxyTrunk',
                    'table_name' => 'ProxyTrunks',
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsAors
     */
    public function setSorceryId($data)
    {

        if ($this->_sorceryId != $data) {
            $this->_logChange('sorceryId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_sorceryId = $data;

        } else if (!is_null($data)) {
            $this->_sorceryId = (string) $data;

        } else {
            $this->_sorceryId = $data;
        }
        return $this;
    }

    /**
     * Gets column sorcery_id
     *
     * @return string
     */
    public function getSorceryId()
    {
        return $this->_sorceryId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\AstPsAors
     */
    public function setTerminalId($data)
    {

        if ($this->_terminalId != $data) {
            $this->_logChange('terminalId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_terminalId = $data;

        } else if (!is_null($data)) {
            $this->_terminalId = (int) $data;

        } else {
            $this->_terminalId = $data;
        }
        return $this;
    }

    /**
     * Gets column terminalId
     *
     * @return int
     */
    public function getTerminalId()
    {
        return $this->_terminalId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\AstPsAors
     */
    public function setProxyTrunkId($data)
    {

        if ($this->_proxyTrunkId != $data) {
            $this->_logChange('proxyTrunkId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_proxyTrunkId = $data;

        } else if (!is_null($data)) {
            $this->_proxyTrunkId = (int) $data;

        } else {
            $this->_proxyTrunkId = $data;
        }
        return $this;
    }

    /**
     * Gets column proxyTrunkId
     *
     * @return int
     */
    public function getProxyTrunkId()
    {
        return $this->_proxyTrunkId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\AstPsAors
     */
    public function setDefaultExpiration($data)
    {

        if ($this->_defaultExpiration != $data) {
            $this->_logChange('defaultExpiration');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_defaultExpiration = $data;

        } else if (!is_null($data)) {
            $this->_defaultExpiration = (int) $data;

        } else {
            $this->_defaultExpiration = $data;
        }
        return $this;
    }

    /**
     * Gets column default_expiration
     *
     * @return int
     */
    public function getDefaultExpiration()
    {
        return $this->_defaultExpiration;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\AstPsAors
     */
    public function setMaxContacts($data)
    {

        if ($this->_maxContacts != $data) {
            $this->_logChange('maxContacts');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_maxContacts = $data;

        } else if (!is_null($data)) {
            $this->_maxContacts = (int) $data;

        } else {
            $this->_maxContacts = $data;
        }
        return $this;
    }

    /**
     * Gets column max_contacts
     *
     * @return int
     */
    public function getMaxContacts()
    {
        return $this->_maxContacts;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\AstPsAors
     */
    public function setMinimumExpiration($data)
    {

        if ($this->_minimumExpiration != $data) {
            $this->_logChange('minimumExpiration');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_minimumExpiration = $data;

        } else if (!is_null($data)) {
            $this->_minimumExpiration = (int) $data;

        } else {
            $this->_minimumExpiration = $data;
        }
        return $this;
    }

    /**
     * Gets column minimum_expiration
     *
     * @return int
     */
    public function getMinimumExpiration()
    {
        return $this->_minimumExpiration;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsAors
     */
    public function setRemoveExisting($data)
    {

        if ($this->_removeExisting != $data) {
            $this->_logChange('removeExisting');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_removeExisting = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_removeExistingAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for removeExisting'));
            }
            $this->_removeExisting = (string) $data;

        } else {
            $this->_removeExisting = $data;
        }
        return $this;
    }

    /**
     * Gets column remove_existing
     *
     * @return string
     */
    public function getRemoveExisting()
    {
        return $this->_removeExisting;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsAors
     */
    public function setAuthenticateQualify($data)
    {

        if ($this->_authenticateQualify != $data) {
            $this->_logChange('authenticateQualify');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_authenticateQualify = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_authenticateQualifyAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for authenticateQualify'));
            }
            $this->_authenticateQualify = (string) $data;

        } else {
            $this->_authenticateQualify = $data;
        }
        return $this;
    }

    /**
     * Gets column authenticate_qualify
     *
     * @return string
     */
    public function getAuthenticateQualify()
    {
        return $this->_authenticateQualify;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\AstPsAors
     */
    public function setMaximumExpiration($data)
    {

        if ($this->_maximumExpiration != $data) {
            $this->_logChange('maximumExpiration');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_maximumExpiration = $data;

        } else if (!is_null($data)) {
            $this->_maximumExpiration = (int) $data;

        } else {
            $this->_maximumExpiration = $data;
        }
        return $this;
    }

    /**
     * Gets column maximum_expiration
     *
     * @return int
     */
    public function getMaximumExpiration()
    {
        return $this->_maximumExpiration;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsAors
     */
    public function setSupportPath($data)
    {

        if ($this->_supportPath != $data) {
            $this->_logChange('supportPath');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_supportPath = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_supportPathAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for supportPath'));
            }
            $this->_supportPath = (string) $data;

        } else {
            $this->_supportPath = $data;
        }
        return $this;
    }

    /**
     * Gets column support_path
     *
     * @return string
     */
    public function getSupportPath()
    {
        return $this->_supportPath;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\AstPsAors
     */
    public function setContact($data)
    {

        if ($this->_contact != $data) {
            $this->_logChange('contact');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_contact = $data;

        } else if (!is_null($data)) {
            $this->_contact = (string) $data;

        } else {
            $this->_contact = $data;
        }
        return $this;
    }

    /**
     * Gets column contact
     *
     * @return string
     */
    public function getContact()
    {
        return $this->_contact;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\AstPsAors
     */
    public function setQualifyFrequency($data)
    {

        if ($this->_qualifyFrequency != $data) {
            $this->_logChange('qualifyFrequency');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_qualifyFrequency = $data;

        } else if (!is_null($data)) {
            $this->_qualifyFrequency = (int) $data;

        } else {
            $this->_qualifyFrequency = $data;
        }
        return $this;
    }

    /**
     * Gets column qualify_frequency
     *
     * @return int
     */
    public function getQualifyFrequency()
    {
        return $this->_qualifyFrequency;
    }

    /**
     * Sets parent relation Terminal
     *
     * @param \IvozProvider\Model\Raw\Terminals $data
     * @return \IvozProvider\Model\Raw\AstPsAors
     */
    public function setTerminal(\IvozProvider\Model\Raw\Terminals $data)
    {
        $this->_Terminal = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setTerminalId($primaryKey);
        }

        $this->_setLoaded('AstPsAorsIbfk1');
        return $this;
    }

    /**
     * Gets parent Terminal
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Terminals
     */
    public function getTerminal($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'AstPsAorsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Terminal = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Terminal;
    }

    /**
     * Sets parent relation ProxyTrunk
     *
     * @param \IvozProvider\Model\Raw\ProxyTrunks $data
     * @return \IvozProvider\Model\Raw\AstPsAors
     */
    public function setProxyTrunk(\IvozProvider\Model\Raw\ProxyTrunks $data)
    {
        $this->_ProxyTrunk = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setProxyTrunkId($primaryKey);
        }

        $this->_setLoaded('AstPsAorsIbfk2');
        return $this;
    }

    /**
     * Gets parent ProxyTrunk
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\ProxyTrunks
     */
    public function getProxyTrunk($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'AstPsAorsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_ProxyTrunk = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_ProxyTrunk;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\AstPsAors
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\AstPsAors')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\AstPsAors);

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
     * @return null | \IvozProvider\Model\Validator\AstPsAors
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\AstPsAors')) {

                $this->setValidator(new \IvozProvider\Validator\AstPsAors);
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
     * @see \Mapper\Sql\AstPsAors::delete
     * @return int|boolean Number of rows deleted or boolean if doing soft delete
     */
    public function deleteRowByPrimaryKey()
    {
        if ($this->getSorceryId() === null) {
            $this->_logger->log('The value for SorceryId cannot be null in deleteRowByPrimaryKey for ' . get_class($this), \Zend_Log::ERR);
            throw new \Exception('Primary Key does not contain a value');
        }

        return $this->getMapper()->getDbTable()->delete(
            'sorcery_id = ' .
             $this->getMapper()->getDbTable()->getAdapter()->quote($this->getSorceryId())
        );
    }

    public function mustUpdateEtag()
    {
        return true;
    }

}