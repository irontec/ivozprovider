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
    protected $_defaultExpiration;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_mailboxes;

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
     * Database var type int
     *
     * @var int
     */
    protected $_qualifyFrequency;

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
     * Database var type varchar
     *
     * @var string
     */
    protected $_outboundProxy;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_supportPath;




    protected $_columnsList = array(
        'sorcery_id'=>'sorceryId',
        'contact'=>'contact',
        'default_expiration'=>'defaultExpiration',
        'mailboxes'=>'mailboxes',
        'max_contacts'=>'maxContacts',
        'minimum_expiration'=>'minimumExpiration',
        'remove_existing'=>'removeExisting',
        'qualify_frequency'=>'qualifyFrequency',
        'authenticate_qualify'=>'authenticateQualify',
        'maximum_expiration'=>'maximumExpiration',
        'outbound_proxy'=>'outboundProxy',
        'support_path'=>'supportPath',
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
     * @return \Oasis\Model\Raw\AstPsAors
     */
    public function setSorceryId($data)
    {

        if ($this->_sorceryId != $data) {
            $this->_logChange('sorceryId');
        }

        if (!is_null($data)) {
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
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsAors
     */
    public function setContact($data)
    {

        if ($this->_contact != $data) {
            $this->_logChange('contact');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstPsAors
     */
    public function setDefaultExpiration($data)
    {

        if ($this->_defaultExpiration != $data) {
            $this->_logChange('defaultExpiration');
        }

        if (!is_null($data)) {
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
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsAors
     */
    public function setMailboxes($data)
    {

        if ($this->_mailboxes != $data) {
            $this->_logChange('mailboxes');
        }

        if (!is_null($data)) {
            $this->_mailboxes = (string) $data;
        } else {
            $this->_mailboxes = $data;
        }
        return $this;
    }

    /**
     * Gets column mailboxes
     *
     * @return string
     */
    public function getMailboxes()
    {
            return $this->_mailboxes;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsAors
     */
    public function setMaxContacts($data)
    {

        if ($this->_maxContacts != $data) {
            $this->_logChange('maxContacts');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstPsAors
     */
    public function setMinimumExpiration($data)
    {

        if ($this->_minimumExpiration != $data) {
            $this->_logChange('minimumExpiration');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstPsAors
     */
    public function setRemoveExisting($data)
    {

        if ($this->_removeExisting != $data) {
            $this->_logChange('removeExisting');
        }

        if (!is_null($data)) {
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
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsAors
     */
    public function setQualifyFrequency($data)
    {

        if ($this->_qualifyFrequency != $data) {
            $this->_logChange('qualifyFrequency');
        }

        if (!is_null($data)) {
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
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsAors
     */
    public function setAuthenticateQualify($data)
    {

        if ($this->_authenticateQualify != $data) {
            $this->_logChange('authenticateQualify');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstPsAors
     */
    public function setMaximumExpiration($data)
    {

        if ($this->_maximumExpiration != $data) {
            $this->_logChange('maximumExpiration');
        }

        if (!is_null($data)) {
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
     * @return \Oasis\Model\Raw\AstPsAors
     */
    public function setOutboundProxy($data)
    {

        if ($this->_outboundProxy != $data) {
            $this->_logChange('outboundProxy');
        }

        if (!is_null($data)) {
            $this->_outboundProxy = (string) $data;
        } else {
            $this->_outboundProxy = $data;
        }
        return $this;
    }

    /**
     * Gets column outbound_proxy
     *
     * @return string
     */
    public function getOutboundProxy()
    {
            return $this->_outboundProxy;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsAors
     */
    public function setSupportPath($data)
    {

        if ($this->_supportPath != $data) {
            $this->_logChange('supportPath');
        }

        if (!is_null($data)) {
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
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\AstPsAors
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\AstPsAors')) {

                $this->setMapper(new \Oasis\Mapper\Sql\AstPsAors);

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
     * @return null | \Oasis\Model\Validator\AstPsAors
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\AstPsAors')) {

                $this->setValidator(new \Oasis\Validator\AstPsAors);
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
}
