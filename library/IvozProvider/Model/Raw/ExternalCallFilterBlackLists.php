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
class ExternalCallFilterBlackLists extends ModelAbstract
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
    protected $_filterId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_matchListId;


    /**
     * Parent relation ExternalCallFilterBlackLists_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\ExternalCallFilters
     */
    protected $_Filter;

    /**
     * Parent relation ExternalCallFilterBlackLists_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\MatchLists
     */
    protected $_MatchList;


    protected $_columnsList = array(
        'id'=>'id',
        'filterId'=>'filterId',
        'matchListId'=>'matchListId',
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
            'ExternalCallFilterBlackListsIbfk1'=> array(
                    'property' => 'Filter',
                    'table_name' => 'ExternalCallFilters',
                ),
            'ExternalCallFilterBlackListsIbfk2'=> array(
                    'property' => 'MatchList',
                    'table_name' => 'MatchLists',
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
     * @param int $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilterBlackLists
     */
    public function setId($data)
    {

        if ($this->_id != $data) {
            $this->_logChange('id', $this->_id, $data);
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
     * @return \IvozProvider\Model\Raw\ExternalCallFilterBlackLists
     */
    public function setFilterId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_filterId != $data) {
            $this->_logChange('filterId', $this->_filterId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_filterId = $data;

        } else if (!is_null($data)) {
            $this->_filterId = (int) $data;

        } else {
            $this->_filterId = $data;
        }
        return $this;
    }

    /**
     * Gets column filterId
     *
     * @return int
     */
    public function getFilterId()
    {
        return $this->_filterId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilterBlackLists
     */
    public function setMatchListId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_matchListId != $data) {
            $this->_logChange('matchListId', $this->_matchListId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_matchListId = $data;

        } else if (!is_null($data)) {
            $this->_matchListId = (int) $data;

        } else {
            $this->_matchListId = $data;
        }
        return $this;
    }

    /**
     * Gets column matchListId
     *
     * @return int
     */
    public function getMatchListId()
    {
        return $this->_matchListId;
    }

    /**
     * Sets parent relation Filter
     *
     * @param \IvozProvider\Model\Raw\ExternalCallFilters $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilterBlackLists
     */
    public function setFilter(\IvozProvider\Model\Raw\ExternalCallFilters $data)
    {
        $this->_Filter = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setFilterId($primaryKey);
        }

        $this->_setLoaded('ExternalCallFilterBlackListsIbfk1');
        return $this;
    }

    /**
     * Gets parent Filter
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\ExternalCallFilters
     */
    public function getFilter($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExternalCallFilterBlackListsIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Filter = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Filter;
    }

    /**
     * Sets parent relation MatchList
     *
     * @param \IvozProvider\Model\Raw\MatchLists $data
     * @return \IvozProvider\Model\Raw\ExternalCallFilterBlackLists
     */
    public function setMatchList(\IvozProvider\Model\Raw\MatchLists $data)
    {
        $this->_MatchList = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setMatchListId($primaryKey);
        }

        $this->_setLoaded('ExternalCallFilterBlackListsIbfk2');
        return $this;
    }

    /**
     * Gets parent MatchList
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\MatchLists
     */
    public function getMatchList($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ExternalCallFilterBlackListsIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_MatchList = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_MatchList;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\ExternalCallFilterBlackLists
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\ExternalCallFilterBlackLists')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\ExternalCallFilterBlackLists);

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
     * @return null | \IvozProvider\Model\Validator\ExternalCallFilterBlackLists
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\ExternalCallFilterBlackLists')) {

                $this->setValidator(new \IvozProvider\Validator\ExternalCallFilterBlackLists);
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
     * @see \Mapper\Sql\ExternalCallFilterBlackLists::delete
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