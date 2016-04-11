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
class NumericTransformRules extends ModelAbstract
{


    /**
     * [uuid:php]
     * Database var type binary(36)
     *
     * @var binary
     */
    protected $_id;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_regExp;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_brandId;


    /**
     * Parent relation NumericTransformRules_ibfk_1
     *
     * @var \Oasis\Model\Raw\Brands
     */
    protected $_Brand;


    /**
     * Dependent relation PeerServesRelNumericTransformRules_ibfk_2
     * Type: One-to-Many relationship
     *
     * @var \Oasis\Model\Raw\PeerServesRelNumericTransformRules[]
     */
    protected $_PeerServesRelNumericTransformRules;


    protected $_columnsList = array(
        'id'=>'id',
        'regExp'=>'regExp',
        'brandId'=>'brandId',
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
            'NumericTransformRulesIbfk1'=> array(
                    'property' => 'Brand',
                    'table_name' => 'Brands',
                ),
        ));

        $this->setDependentList(array(
            'PeerServesRelNumericTransformRulesIbfk2' => array(
                    'property' => 'PeerServesRelNumericTransformRules',
                    'table_name' => 'PeerServesRelNumericTransformRules',
                ),
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
     * @param binary $data
     * @return \Oasis\Model\Raw\NumericTransformRules
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
     * @param string $data
     * @return \Oasis\Model\Raw\NumericTransformRules
     */
    public function setRegExp($data)
    {

        if ($this->_regExp != $data) {
            $this->_logChange('regExp');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_regExp = $data;
        } else if (!is_null($data)) {
            $this->_regExp = (string) $data;
        } else {
            $this->_regExp = $data;
        }
        return $this;
    }

    /**
     * Gets column regExp
     *
     * @return string
     */
    public function getRegExp()
    {
            return $this->_regExp;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\NumericTransformRules
     */
    public function setBrandId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }

        if ($this->_brandId != $data) {
            $this->_logChange('brandId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_brandId = $data;
        } else if (!is_null($data)) {
            $this->_brandId = (int) $data;
        } else {
            $this->_brandId = $data;
        }
        return $this;
    }

    /**
     * Gets column brandId
     *
     * @return int
     */
    public function getBrandId()
    {
            return $this->_brandId;
    }


    /**
     * Sets parent relation Brand
     *
     * @param \Oasis\Model\Raw\Brands $data
     * @return \Oasis\Model\Raw\NumericTransformRules
     */
    public function setBrand(\Oasis\Model\Raw\Brands $data)
    {
        $this->_Brand = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setBrandId($primaryKey);
        }

        $this->_setLoaded('NumericTransformRulesIbfk1');
        return $this;
    }

    /**
     * Gets parent Brand
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Oasis\Model\Raw\Brands
     */
    public function getBrand($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'NumericTransformRulesIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Brand = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Brand;
    }

    /**
     * Sets dependent relations PeerServesRelNumericTransformRules_ibfk_2
     *
     * @param array $data An array of \Oasis\Model\Raw\PeerServesRelNumericTransformRules
     * @return \Oasis\Model\Raw\NumericTransformRules
     */
    public function setPeerServesRelNumericTransformRules(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_PeerServesRelNumericTransformRules === null) {

                $this->getPeerServesRelNumericTransformRules();
            }

            $oldRelations = $this->_PeerServesRelNumericTransformRules;

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

        $this->_PeerServesRelNumericTransformRules = array();

        foreach ($data as $object) {
            $this->addPeerServesRelNumericTransformRules($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations PeerServesRelNumericTransformRules_ibfk_2
     *
     * @param \Oasis\Model\Raw\PeerServesRelNumericTransformRules $data
     * @return \Oasis\Model\Raw\NumericTransformRules
     */
    public function addPeerServesRelNumericTransformRules(\Oasis\Model\Raw\PeerServesRelNumericTransformRules $data)
    {
        $this->_PeerServesRelNumericTransformRules[] = $data;
        $this->_setLoaded('PeerServesRelNumericTransformRulesIbfk2');
        return $this;
    }

    /**
     * Gets dependent PeerServesRelNumericTransformRules_ibfk_2
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \Oasis\Model\Raw\PeerServesRelNumericTransformRules
     */
    public function getPeerServesRelNumericTransformRules($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'PeerServesRelNumericTransformRulesIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_PeerServesRelNumericTransformRules = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_PeerServesRelNumericTransformRules;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\NumericTransformRules
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\NumericTransformRules')) {

                $this->setMapper(new \Oasis\Mapper\Sql\NumericTransformRules);

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
     * @return null | \Oasis\Model\Validator\NumericTransformRules
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\NumericTransformRules')) {

                $this->setValidator(new \Oasis\Validator\NumericTransformRules);
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
     * @see \Mapper\Sql\NumericTransformRules::delete
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
}
