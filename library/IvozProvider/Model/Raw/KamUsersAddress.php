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
class KamUsersAddress extends ModelAbstract
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
    protected $_grp;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_ipAddr;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_mask;

    /**
     * Database var type smallint
     *
     * @var int
     */
    protected $_port;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_tag;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_peerServerId;


    /**
     * Parent relation kam_users_address_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\PeerServers
     */
    protected $_PeerServer;


    protected $_columnsList = array(
        'id'=>'id',
        'grp'=>'grp',
        'ip_addr'=>'ipAddr',
        'mask'=>'mask',
        'port'=>'port',
        'tag'=>'tag',
        'peerServerId'=>'peerServerId',
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
            'KamUsersAddressIbfk1'=> array(
                    'property' => 'PeerServer',
                    'table_name' => 'PeerServers',
                ),
        ));

        $this->setDependentList(array(
        ));




        $this->_defaultValues = array(
            'grp' => '1',
            'mask' => '32',
            'port' => '0',
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
     * @return \IvozProvider\Model\Raw\KamUsersAddress
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
     * @return \IvozProvider\Model\Raw\KamUsersAddress
     */
    public function setGrp($data)
    {

        if ($this->_grp != $data) {
            $this->_logChange('grp');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_grp = $data;

        } else if (!is_null($data)) {
            $this->_grp = (int) $data;

        } else {
            $this->_grp = $data;
        }
        return $this;
    }

    /**
     * Gets column grp
     *
     * @return int
     */
    public function getGrp()
    {
        return $this->_grp;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamUsersAddress
     */
    public function setIpAddr($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_ipAddr != $data) {
            $this->_logChange('ipAddr');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_ipAddr = $data;

        } else if (!is_null($data)) {
            $this->_ipAddr = (string) $data;

        } else {
            $this->_ipAddr = $data;
        }
        return $this;
    }

    /**
     * Gets column ip_addr
     *
     * @return string
     */
    public function getIpAddr()
    {
        return $this->_ipAddr;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\KamUsersAddress
     */
    public function setMask($data)
    {

        if ($this->_mask != $data) {
            $this->_logChange('mask');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_mask = $data;

        } else if (!is_null($data)) {
            $this->_mask = (int) $data;

        } else {
            $this->_mask = $data;
        }
        return $this;
    }

    /**
     * Gets column mask
     *
     * @return int
     */
    public function getMask()
    {
        return $this->_mask;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\KamUsersAddress
     */
    public function setPort($data)
    {

        if ($this->_port != $data) {
            $this->_logChange('port');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_port = $data;

        } else if (!is_null($data)) {
            $this->_port = (int) $data;

        } else {
            $this->_port = $data;
        }
        return $this;
    }

    /**
     * Gets column port
     *
     * @return int
     */
    public function getPort()
    {
        return $this->_port;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\KamUsersAddress
     */
    public function setTag($data)
    {

        if ($this->_tag != $data) {
            $this->_logChange('tag');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_tag = $data;

        } else if (!is_null($data)) {
            $this->_tag = (string) $data;

        } else {
            $this->_tag = $data;
        }
        return $this;
    }

    /**
     * Gets column tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->_tag;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\KamUsersAddress
     */
    public function setPeerServerId($data)
    {

        if ($this->_peerServerId != $data) {
            $this->_logChange('peerServerId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_peerServerId = $data;

        } else if (!is_null($data)) {
            $this->_peerServerId = (int) $data;

        } else {
            $this->_peerServerId = $data;
        }
        return $this;
    }

    /**
     * Gets column peerServerId
     *
     * @return int
     */
    public function getPeerServerId()
    {
        return $this->_peerServerId;
    }

    /**
     * Sets parent relation PeerServer
     *
     * @param \IvozProvider\Model\Raw\PeerServers $data
     * @return \IvozProvider\Model\Raw\KamUsersAddress
     */
    public function setPeerServer(\IvozProvider\Model\Raw\PeerServers $data)
    {
        $this->_PeerServer = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setPeerServerId($primaryKey);
        }

        $this->_setLoaded('KamUsersAddressIbfk1');
        return $this;
    }

    /**
     * Gets parent PeerServer
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\PeerServers
     */
    public function getPeerServer($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamUsersAddressIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_PeerServer = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_PeerServer;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\KamUsersAddress
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\KamUsersAddress')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\KamUsersAddress);

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
     * @return null | \IvozProvider\Model\Validator\KamUsersAddress
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\KamUsersAddress')) {

                $this->setValidator(new \IvozProvider\Validator\KamUsersAddress);
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
     * @see \Mapper\Sql\KamUsersAddress::delete
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