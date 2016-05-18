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
class FixedCostsRelInvoices extends ModelAbstract
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
    protected $_brandId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_fixedCostId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_invoiceId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_quantity;


    /**
     * Parent relation FixedCostsRelInvoices_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Brands
     */
    protected $_Brand;

    /**
     * Parent relation FixedCostsRelInvoices_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\FixedCosts
     */
    protected $_FixedCost;

    /**
     * Parent relation FixedCostsRelInvoices_ibfk_3
     *
     * @var \IvozProvider\Model\Raw\Invoices
     */
    protected $_Invoice;


    protected $_columnsList = array(
        'id'=>'id',
        'brandId'=>'brandId',
        'fixedCostId'=>'fixedCostId',
        'invoiceId'=>'invoiceId',
        'quantity'=>'quantity',
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
            'FixedCostsRelInvoicesIbfk1'=> array(
                    'property' => 'Brand',
                    'table_name' => 'Brands',
                ),
            'FixedCostsRelInvoicesIbfk2'=> array(
                    'property' => 'FixedCost',
                    'table_name' => 'FixedCosts',
                ),
            'FixedCostsRelInvoicesIbfk3'=> array(
                    'property' => 'Invoice',
                    'table_name' => 'Invoices',
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
     * @return \IvozProvider\Model\Raw\FixedCostsRelInvoices
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
     * @return \IvozProvider\Model\Raw\FixedCostsRelInvoices
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
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\FixedCostsRelInvoices
     */
    public function setFixedCostId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_fixedCostId != $data) {
            $this->_logChange('fixedCostId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_fixedCostId = $data;

        } else if (!is_null($data)) {
            $this->_fixedCostId = (int) $data;

        } else {
            $this->_fixedCostId = $data;
        }
        return $this;
    }

    /**
     * Gets column fixedCostId
     *
     * @return int
     */
    public function getFixedCostId()
    {
        return $this->_fixedCostId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\FixedCostsRelInvoices
     */
    public function setInvoiceId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_invoiceId != $data) {
            $this->_logChange('invoiceId');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_invoiceId = $data;

        } else if (!is_null($data)) {
            $this->_invoiceId = (int) $data;

        } else {
            $this->_invoiceId = $data;
        }
        return $this;
    }

    /**
     * Gets column invoiceId
     *
     * @return int
     */
    public function getInvoiceId()
    {
        return $this->_invoiceId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\FixedCostsRelInvoices
     */
    public function setQuantity($data)
    {

        if ($this->_quantity != $data) {
            $this->_logChange('quantity');
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_quantity = $data;

        } else if (!is_null($data)) {
            $this->_quantity = (int) $data;

        } else {
            $this->_quantity = $data;
        }
        return $this;
    }

    /**
     * Gets column quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->_quantity;
    }

    /**
     * Sets parent relation Brand
     *
     * @param \IvozProvider\Model\Raw\Brands $data
     * @return \IvozProvider\Model\Raw\FixedCostsRelInvoices
     */
    public function setBrand(\IvozProvider\Model\Raw\Brands $data)
    {
        $this->_Brand = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setBrandId($primaryKey);
        }

        $this->_setLoaded('FixedCostsRelInvoicesIbfk1');
        return $this;
    }

    /**
     * Gets parent Brand
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function getBrand($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FixedCostsRelInvoicesIbfk1';

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
     * Sets parent relation FixedCost
     *
     * @param \IvozProvider\Model\Raw\FixedCosts $data
     * @return \IvozProvider\Model\Raw\FixedCostsRelInvoices
     */
    public function setFixedCost(\IvozProvider\Model\Raw\FixedCosts $data)
    {
        $this->_FixedCost = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setFixedCostId($primaryKey);
        }

        $this->_setLoaded('FixedCostsRelInvoicesIbfk2');
        return $this;
    }

    /**
     * Gets parent FixedCost
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\FixedCosts
     */
    public function getFixedCost($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FixedCostsRelInvoicesIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_FixedCost = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_FixedCost;
    }

    /**
     * Sets parent relation Invoice
     *
     * @param \IvozProvider\Model\Raw\Invoices $data
     * @return \IvozProvider\Model\Raw\FixedCostsRelInvoices
     */
    public function setInvoice(\IvozProvider\Model\Raw\Invoices $data)
    {
        $this->_Invoice = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setInvoiceId($primaryKey);
        }

        $this->_setLoaded('FixedCostsRelInvoicesIbfk3');
        return $this;
    }

    /**
     * Gets parent Invoice
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Invoices
     */
    public function getInvoice($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FixedCostsRelInvoicesIbfk3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Invoice = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Invoice;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\FixedCostsRelInvoices
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\FixedCostsRelInvoices')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\FixedCostsRelInvoices);

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
     * @return null | \IvozProvider\Model\Validator\FixedCostsRelInvoices
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\FixedCostsRelInvoices')) {

                $this->setValidator(new \IvozProvider\Validator\FixedCostsRelInvoices);
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
     * @see \Mapper\Sql\FixedCostsRelInvoices::delete
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