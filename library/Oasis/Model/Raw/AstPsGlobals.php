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
class AstPsGlobals extends ModelAbstract
{


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
    protected $_maxForwards;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_userAgent;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_defaultOutboundEndpoint;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_debug;




    protected $_columnsList = array(
        'sorcery_id'=>'sorceryId',
        'max_forwards'=>'maxForwards',
        'user_agent'=>'userAgent',
        'default_outbound_endpoint'=>'defaultOutboundEndpoint',
        'debug'=>'debug',
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
     * @return \Oasis\Model\Raw\AstPsGlobals
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
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsGlobals
     */
    public function setMaxForwards($data)
    {

        if ($this->_maxForwards != $data) {
            $this->_logChange('maxForwards');
        }

        if (!is_null($data)) {
            $this->_maxForwards = (int) $data;
        } else {
            $this->_maxForwards = $data;
        }
        return $this;
    }

    /**
     * Gets column max_forwards
     *
     * @return int
     */
    public function getMaxForwards()
    {
            return $this->_maxForwards;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsGlobals
     */
    public function setUserAgent($data)
    {

        if ($this->_userAgent != $data) {
            $this->_logChange('userAgent');
        }

        if (!is_null($data)) {
            $this->_userAgent = (string) $data;
        } else {
            $this->_userAgent = $data;
        }
        return $this;
    }

    /**
     * Gets column user_agent
     *
     * @return string
     */
    public function getUserAgent()
    {
            return $this->_userAgent;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsGlobals
     */
    public function setDefaultOutboundEndpoint($data)
    {

        if ($this->_defaultOutboundEndpoint != $data) {
            $this->_logChange('defaultOutboundEndpoint');
        }

        if (!is_null($data)) {
            $this->_defaultOutboundEndpoint = (string) $data;
        } else {
            $this->_defaultOutboundEndpoint = $data;
        }
        return $this;
    }

    /**
     * Gets column default_outbound_endpoint
     *
     * @return string
     */
    public function getDefaultOutboundEndpoint()
    {
            return $this->_defaultOutboundEndpoint;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsGlobals
     */
    public function setDebug($data)
    {

        if ($this->_debug != $data) {
            $this->_logChange('debug');
        }

        if (!is_null($data)) {
            $this->_debug = (string) $data;
        } else {
            $this->_debug = $data;
        }
        return $this;
    }

    /**
     * Gets column debug
     *
     * @return string
     */
    public function getDebug()
    {
            return $this->_debug;
    }


    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\AstPsGlobals
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\AstPsGlobals')) {

                $this->setMapper(new \Oasis\Mapper\Sql\AstPsGlobals);

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
     * @return null | \Oasis\Model\Validator\AstPsGlobals
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\AstPsGlobals')) {

                $this->setValidator(new \Oasis\Validator\AstPsGlobals);
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
     * @see \Mapper\Sql\AstPsGlobals::delete
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
