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
class AstPsSystems extends ModelAbstract
{

    protected $_compactHeadersAcceptedValues = array(
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
    protected $_timerT1;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_timerB;

    /**
     * Database var type enum('yes','no')
     *
     * @var string
     */
    protected $_compactHeaders;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_threadpoolInitialSize;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_threadpoolAutoIncrement;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_threadpoolIdleTimeout;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_threadpoolMaxSize;




    protected $_columnsList = array(
        'sorcery_id'=>'sorceryId',
        'timer_t1'=>'timerT1',
        'timer_b'=>'timerB',
        'compact_headers'=>'compactHeaders',
        'threadpool_initial_size'=>'threadpoolInitialSize',
        'threadpool_auto_increment'=>'threadpoolAutoIncrement',
        'threadpool_idle_timeout'=>'threadpoolIdleTimeout',
        'threadpool_max_size'=>'threadpoolMaxSize',
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
     * @return \Oasis\Model\Raw\AstPsSystems
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
     * @return \Oasis\Model\Raw\AstPsSystems
     */
    public function setTimerT1($data)
    {

        if ($this->_timerT1 != $data) {
            $this->_logChange('timerT1');
        }

        if (!is_null($data)) {
            $this->_timerT1 = (int) $data;
        } else {
            $this->_timerT1 = $data;
        }
        return $this;
    }

    /**
     * Gets column timer_t1
     *
     * @return int
     */
    public function getTimerT1()
    {
            return $this->_timerT1;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsSystems
     */
    public function setTimerB($data)
    {

        if ($this->_timerB != $data) {
            $this->_logChange('timerB');
        }

        if (!is_null($data)) {
            $this->_timerB = (int) $data;
        } else {
            $this->_timerB = $data;
        }
        return $this;
    }

    /**
     * Gets column timer_b
     *
     * @return int
     */
    public function getTimerB()
    {
            return $this->_timerB;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\AstPsSystems
     */
    public function setCompactHeaders($data)
    {

        if ($this->_compactHeaders != $data) {
            $this->_logChange('compactHeaders');
        }

        if (!is_null($data)) {
            if (!in_array($data, $this->_compactHeadersAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for compactHeaders'));
            }
            $this->_compactHeaders = (string) $data;
        } else {
            $this->_compactHeaders = $data;
        }
        return $this;
    }

    /**
     * Gets column compact_headers
     *
     * @return string
     */
    public function getCompactHeaders()
    {
            return $this->_compactHeaders;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsSystems
     */
    public function setThreadpoolInitialSize($data)
    {

        if ($this->_threadpoolInitialSize != $data) {
            $this->_logChange('threadpoolInitialSize');
        }

        if (!is_null($data)) {
            $this->_threadpoolInitialSize = (int) $data;
        } else {
            $this->_threadpoolInitialSize = $data;
        }
        return $this;
    }

    /**
     * Gets column threadpool_initial_size
     *
     * @return int
     */
    public function getThreadpoolInitialSize()
    {
            return $this->_threadpoolInitialSize;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsSystems
     */
    public function setThreadpoolAutoIncrement($data)
    {

        if ($this->_threadpoolAutoIncrement != $data) {
            $this->_logChange('threadpoolAutoIncrement');
        }

        if (!is_null($data)) {
            $this->_threadpoolAutoIncrement = (int) $data;
        } else {
            $this->_threadpoolAutoIncrement = $data;
        }
        return $this;
    }

    /**
     * Gets column threadpool_auto_increment
     *
     * @return int
     */
    public function getThreadpoolAutoIncrement()
    {
            return $this->_threadpoolAutoIncrement;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsSystems
     */
    public function setThreadpoolIdleTimeout($data)
    {

        if ($this->_threadpoolIdleTimeout != $data) {
            $this->_logChange('threadpoolIdleTimeout');
        }

        if (!is_null($data)) {
            $this->_threadpoolIdleTimeout = (int) $data;
        } else {
            $this->_threadpoolIdleTimeout = $data;
        }
        return $this;
    }

    /**
     * Gets column threadpool_idle_timeout
     *
     * @return int
     */
    public function getThreadpoolIdleTimeout()
    {
            return $this->_threadpoolIdleTimeout;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\AstPsSystems
     */
    public function setThreadpoolMaxSize($data)
    {

        if ($this->_threadpoolMaxSize != $data) {
            $this->_logChange('threadpoolMaxSize');
        }

        if (!is_null($data)) {
            $this->_threadpoolMaxSize = (int) $data;
        } else {
            $this->_threadpoolMaxSize = $data;
        }
        return $this;
    }

    /**
     * Gets column threadpool_max_size
     *
     * @return int
     */
    public function getThreadpoolMaxSize()
    {
            return $this->_threadpoolMaxSize;
    }


    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\AstPsSystems
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\AstPsSystems')) {

                $this->setMapper(new \Oasis\Mapper\Sql\AstPsSystems);

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
     * @return null | \Oasis\Model\Validator\AstPsSystems
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\AstPsSystems')) {

                $this->setValidator(new \Oasis\Validator\AstPsSystems);
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
     * @see \Mapper\Sql\AstPsSystems::delete
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
