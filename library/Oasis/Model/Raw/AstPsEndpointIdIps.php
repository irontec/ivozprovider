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
class AstPsEndpointIdIps extends ModelAbstract
{


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
    protected $_endpoint;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_match;




    protected $_columnsList = array(
        'sorcery_id'=>'sorceryId',
        'endpoint'=>'endpoint',
        'match'=>'match',
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
     * @return \Oasis\Model\Raw\AstPsEndpointIdIps
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
     * @return \Oasis\Model\Raw\AstPsEndpointIdIps
     */
    public function setEndpoint($data)
    {

        if ($this->_endpoint != $data) {
            $this->_logChange('endpoint');
        }

        if (!is_null($data)) {
            $this->_endpoint = (string) $data;
        } else {
            $this->_endpoint = $data;
        }
        return $this;
    }

    /**
     * Gets column endpoint
     *
     * @return string
     */
    public function getEndpoint()
    {
            return $this->_endpoint;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsEndpointIdIps
     */
    public function setMatch($data)
    {

        if ($this->_match != $data) {
            $this->_logChange('match');
        }

        if (!is_null($data)) {
            $this->_match = (string) $data;
        } else {
            $this->_match = $data;
        }
        return $this;
    }

    /**
     * Gets column match
     *
     * @return string
     */
    public function getMatch()
    {
            return $this->_match;
    }


    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\AstPsEndpointIdIps
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\AstPsEndpointIdIps')) {

                $this->setMapper(new \Oasis\Mapper\Sql\AstPsEndpointIdIps);

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
     * @return null | \Oasis\Model\Validator\AstPsEndpointIdIps
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\AstPsEndpointIdIps')) {

                $this->setValidator(new \Oasis\Validator\AstPsEndpointIdIps);
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
     * @see \Mapper\Sql\AstPsEndpointIdIps::delete
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
