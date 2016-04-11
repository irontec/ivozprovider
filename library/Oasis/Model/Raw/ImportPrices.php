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
class ImportPrices extends ModelAbstract
{


    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_id;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_pricingPlanId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_targetPatternId;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_connectionCharge;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_periodTime;

    /**
     * Database var type decimal
     *
     * @var float
     */
    protected $_perPeriodCharge;

    /**
     * Database var type mediumint
     *
     * @var int
     */
    protected $_importFileId;

    /**
     * Database var type datetime
     *
     * @var string
     */
    protected $_importedOn;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_brandId;


    /**
     * Parent relation ImportPrices_ibfk_1
     *
     * @var \Oasis\Model\Raw\ImportFiles
     */
    protected $_ImportFile;

    /**
     * Parent relation ImportPrices_ibfk_2
     *
     * @var \Oasis\Model\Raw\Brands
     */
    protected $_Brand;


    protected $_columnsList = array(
        'id'=>'id',
        'pricingPlanId'=>'pricingPlanId',
        'targetPatternId'=>'targetPatternId',
        'connectionCharge'=>'connectionCharge',
        'periodTime'=>'periodTime',
        'perPeriodCharge'=>'perPeriodCharge',
        'importFileId'=>'importFileId',
        'importedOn'=>'importedOn',
        'brandId'=>'brandId',
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
            'ImportPricesIbfk1'=> array(
                    'property' => 'ImportFile',
                    'table_name' => 'ImportFiles',
                ),
            'ImportPricesIbfk2'=> array(
                    'property' => 'Brand',
                    'table_name' => 'Brands',
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
     * @return \Oasis\Model\Raw\ImportPrices
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
     * @return \Oasis\Model\Raw\ImportPrices
     */
    public function setPricingPlanId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }

        if ($this->_pricingPlanId != $data) {
            $this->_logChange('pricingPlanId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_pricingPlanId = $data;
        } else if (!is_null($data)) {
            $this->_pricingPlanId = (string) $data;
        } else {
            $this->_pricingPlanId = $data;
        }
        return $this;
    }

    /**
     * Gets column pricingPlanId
     *
     * @return string
     */
    public function getPricingPlanId()
    {
            return $this->_pricingPlanId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\ImportPrices
     */
    public function setTargetPatternId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }

        if ($this->_targetPatternId != $data) {
            $this->_logChange('targetPatternId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_targetPatternId = $data;
        } else if (!is_null($data)) {
            $this->_targetPatternId = (string) $data;
        } else {
            $this->_targetPatternId = $data;
        }
        return $this;
    }

    /**
     * Gets column targetPatternId
     *
     * @return string
     */
    public function getTargetPatternId()
    {
            return $this->_targetPatternId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\ImportPrices
     */
    public function setConnectionCharge($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }

        if ($this->_connectionCharge != $data) {
            $this->_logChange('connectionCharge');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_connectionCharge = $data;
        } else if (!is_null($data)) {
            $this->_connectionCharge = (string) $data;
        } else {
            $this->_connectionCharge = $data;
        }
        return $this;
    }

    /**
     * Gets column connectionCharge
     *
     * @return string
     */
    public function getConnectionCharge()
    {
            return $this->_connectionCharge;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \Oasis\Model\Raw\ImportPrices
     */
    public function setPeriodTime($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }

        if ($this->_periodTime != $data) {
            $this->_logChange('periodTime');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_periodTime = $data;
        } else if (!is_null($data)) {
            $this->_periodTime = (string) $data;
        } else {
            $this->_periodTime = $data;
        }
        return $this;
    }

    /**
     * Gets column periodTime
     *
     * @return string
     */
    public function getPeriodTime()
    {
            return $this->_periodTime;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param float $data
     * @return \Oasis\Model\Raw\ImportPrices
     */
    public function setPerPeriodCharge($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }

        if ($this->_perPeriodCharge != $data) {
            $this->_logChange('perPeriodCharge');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_perPeriodCharge = $data;
        } else if (!is_null($data)) {
            $this->_perPeriodCharge = (float) $data;
        } else {
            $this->_perPeriodCharge = $data;
        }
        return $this;
    }

    /**
     * Gets column perPeriodCharge
     *
     * @return float
     */
    public function getPerPeriodCharge()
    {
            return $this->_perPeriodCharge;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\ImportPrices
     */
    public function setImportFileId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }

        if ($this->_importFileId != $data) {
            $this->_logChange('importFileId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_importFileId = $data;
        } else if (!is_null($data)) {
            $this->_importFileId = (int) $data;
        } else {
            $this->_importFileId = $data;
        }
        return $this;
    }

    /**
     * Gets column importFileId
     *
     * @return int
     */
    public function getImportFileId()
    {
            return $this->_importFileId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date $date
     * @return \Oasis\Model\Raw\ImportPrices
     */
    public function setImportedOn($data)
    {

        if ($data == '0000-00-00 00:00:00') {
            $data = null;
        }

        if ($data === 'CURRENT_TIMESTAMP') {
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


        if ($this->_importedOn != $data) {
            $this->_logChange('importedOn');
        }


        $this->_importedOn = $data;
        return $this;
    }

    /**
     * Gets column importedOn
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getImportedOn($returnZendDate = false)
    {
    
        if (is_null($this->_importedOn)) {

            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_importedOn->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }


        return $this->_importedOn->format('Y-m-d H:i:s');

    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \Oasis\Model\Raw\ImportPrices
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
     * Sets parent relation ImportFile
     *
     * @param \Oasis\Model\Raw\ImportFiles $data
     * @return \Oasis\Model\Raw\ImportPrices
     */
    public function setImportFile(\Oasis\Model\Raw\ImportFiles $data)
    {
        $this->_ImportFile = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setImportFileId($primaryKey);
        }

        $this->_setLoaded('ImportPricesIbfk1');
        return $this;
    }

    /**
     * Gets parent ImportFile
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Oasis\Model\Raw\ImportFiles
     */
    public function getImportFile($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ImportPricesIbfk1';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_ImportFile = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_ImportFile;
    }

    /**
     * Sets parent relation Brand
     *
     * @param \Oasis\Model\Raw\Brands $data
     * @return \Oasis\Model\Raw\ImportPrices
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

        $this->_setLoaded('ImportPricesIbfk2');
        return $this;
    }

    /**
     * Gets parent Brand
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \Oasis\Model\Raw\Brands
     */
    public function getBrand($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'ImportPricesIbfk2';

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
     * Returns the mapper class for this model
     *
     * @return Oasis\Mapper\Sql\ImportPrices
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\Oasis\Mapper\Sql\ImportPrices')) {

                $this->setMapper(new \Oasis\Mapper\Sql\ImportPrices);

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
     * @return null | \Oasis\Model\Validator\ImportPrices
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\Oasis\\Validator\ImportPrices')) {

                $this->setValidator(new \Oasis\Validator\ImportPrices);
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
     * @see \Mapper\Sql\ImportPrices::delete
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
