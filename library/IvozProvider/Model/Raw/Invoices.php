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
class Invoices extends ModelAbstract
{
    /*
     * @var \Iron_Model_Fso
     */
    protected $_pdfFileFso;

    protected $_statusAcceptedValues = array(
        'waiting',
        'processing',
        'created',
        'error',
    );

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_id;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_number;

    /**
     * Database var type datetime
     *
     * @var string
     */
    protected $_inDate;

    /**
     * Database var type datetime
     *
     * @var string
     */
    protected $_outDate;

    /**
     * Database var type decimal
     *
     * @var float
     */
    protected $_total;

    /**
     * Database var type decimal
     *
     * @var float
     */
    protected $_taxRate;

    /**
     * Database var type decimal
     *
     * @var float
     */
    protected $_totalWithTax;

    /**
     * [enum:waiting|processing|created|error]
     * Database var type varchar
     *
     * @var string
     */
    protected $_status;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_companyId;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_brandId;

    /**
     * [FSO]
     * Database var type int
     *
     * @var int
     */
    protected $_pdfFileFileSize;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_pdfFileMimeType;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_pdfFileBaseName;

    /**
     * Database var type int
     *
     * @var int
     */
    protected $_invoiceTemplateId;


    /**
     * Parent relation Invoices_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Brands
     */
    protected $_Brand;

    /**
     * Parent relation Invoices_ibfk_2
     *
     * @var \IvozProvider\Model\Raw\Companies
     */
    protected $_Company;

    /**
     * Parent relation Invoices_ibfk_4
     *
     * @var \IvozProvider\Model\Raw\InvoiceTemplates
     */
    protected $_InvoiceTemplate;


    /**
     * Dependent relation FixedCostsRelInvoices_ibfk_3
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\FixedCostsRelInvoices[]
     */
    protected $_FixedCostsRelInvoices;

    /**
     * Dependent relation kam_acc_cdrs_ibfk_3
     * Type: One-to-Many relationship
     *
     * @var \IvozProvider\Model\Raw\KamAccCdrs[]
     */
    protected $_KamAccCdrs;

    protected $_columnsList = array(
        'id'=>'id',
        'number'=>'number',
        'inDate'=>'inDate',
        'outDate'=>'outDate',
        'total'=>'total',
        'taxRate'=>'taxRate',
        'totalWithTax'=>'totalWithTax',
        'status'=>'status',
        'companyId'=>'companyId',
        'brandId'=>'brandId',
        'pdfFileFileSize'=>'pdfFileFileSize',
        'pdfFileMimeType'=>'pdfFileMimeType',
        'pdfFileBaseName'=>'pdfFileBaseName',
        'invoiceTemplateId'=>'invoiceTemplateId',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'status'=> array('enum:waiting|processing|created|error'),
            'pdfFileFileSize'=> array('FSO'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'InvoicesIbfk1'=> array(
                    'property' => 'Brand',
                    'table_name' => 'Brands',
                ),
            'InvoicesIbfk2'=> array(
                    'property' => 'Company',
                    'table_name' => 'Companies',
                ),
            'InvoicesIbfk4'=> array(
                    'property' => 'InvoiceTemplate',
                    'table_name' => 'InvoiceTemplates',
                ),
        ));

        $this->setDependentList(array(
            'FixedCostsRelInvoicesIbfk3' => array(
                    'property' => 'FixedCostsRelInvoices',
                    'table_name' => 'FixedCostsRelInvoices',
                ),
            'KamAccCdrsIbfk3' => array(
                    'property' => 'KamAccCdrs',
                    'table_name' => 'kam_acc_cdrs',
                ),
        ));

        $this->setOnDeleteCascadeRelationships(array(
            'FixedCostsRelInvoices_ibfk_3'
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
        $this->_pdfFileFso = new \Iron_Model_Fso($this, $this->getPdfFileSpecs());

        return $this;
    }

    public function getFileObjects()
    {

        return array('pdfFile');
    }

    public function getPdfFileSpecs()
    {
        return array(
            'basePath' => 'pdfFile',
            'sizeName' => 'pdfFileFileSize',
            'mimeName' => 'pdfFileMimeType',
            'baseNameName' => 'pdfFileBaseName',
        );
    }

    public function putPdfFile($filePath = '',$baseName = '')
    {
        $this->_pdfFileFso->put($filePath);

        if (!empty($baseName)) {

            $this->_pdfFileFso->setBaseName($baseName);
        }
    }

    public function fetchPdfFile($autoload = true)
    {
        if ($autoload === true && $this->getpdfFileFileSize() > 0) {

            $this->_pdfFileFso->fetch();
        }

        return $this->_pdfFileFso;
    }

    public function removePdfFile()
    {
        $this->_pdfFileFso->remove();
        $this->_pdfFileFso = null;

        return true;
    }

    public function getPdfFileUrl($profile)
    {
        $fsoConfig = \Zend_Registry::get('fsoConfig');
        $profileConf = $fsoConfig->$profile;

        if (is_null($profileConf)) {
            throw new \Exception('Profile invalid. not exist in fso.ini');
        }
        $routeMap = isset($profileConf->routeMap) ? $profileConf->routeMap : $fsoConfig->config->routeMap;

        $fsoColumn = $profileConf->fso;
        $fsoSkipColumns = array(
                $fsoColumn."FileSize",
                $fsoColumn."MimeType",
        );
        $fsoBaseNameColum = $fsoColumn."BaseName";

        foreach ($this->_columnsList as $column) {
            if (in_array($column, $fsoSkipColumns)) {
                continue;
            }
            $getter = "get".ucfirst($column);
            $search = "{".$column."}";
            if ($column == $fsoBaseNameColum) {
                $search = "{basename}";
            }
            $routeMap = str_replace($search, $this->$getter(), $routeMap);
        }

        if (!$routeMap) {
            return null;
        }
        $route = array(
            'profile' => $profile,
            'routeMap' => $routeMap
        );

        if (\Zend_Controller_Front::getInstance()) {
            $view = \Zend_Controller_Front::getInstance()
                ->getParam('bootstrap')
                ->getResource('view');
        } else {
            $view = new \Zend_View();
        }
        $fsoUrl = $view->serverUrl($view->url($route, 'fso'));

        return $fsoUrl;

    }


    /**************************************************************************
    *********************************** /FSO ***********************************
    ***************************************************************************/

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Invoices
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\Invoices
     */
    public function setNumber($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_number != $data) {
            $this->_logChange('number', $this->_number, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_number = $data;

        } else if (!is_null($data)) {
            $this->_number = (string) $data;

        } else {
            $this->_number = $data;
        }
        return $this;
    }

    /**
     * Gets column number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->_number;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \IvozProvider\Model\Raw\Invoices
     */
    public function setInDate($data)
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

        if ($this->_inDate != $data) {
            $this->_logChange('inDate', $this->_inDate, $data);
        }

        $this->_inDate = $data;
        return $this;
    }

    /**
     * Gets column inDate
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getInDate($returnZendDate = false)
    {
        if (is_null($this->_inDate)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_inDate->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_inDate->format('Y-m-d H:i:s');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string|Zend_Date|DateTime $date
     * @return \IvozProvider\Model\Raw\Invoices
     */
    public function setOutDate($data)
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

        if ($this->_outDate != $data) {
            $this->_logChange('outDate', $this->_outDate, $data);
        }

        $this->_outDate = $data;
        return $this;
    }

    /**
     * Gets column outDate
     *
     * @param boolean $returnZendDate
     * @return Zend_Date|null|string Zend_Date representation of this datetime if enabled, or ISO 8601 string if not
     */
    public function getOutDate($returnZendDate = false)
    {
        if (is_null($this->_outDate)) {
            return null;
        }

        if ($returnZendDate) {
            $zendDate = new \Zend_Date($this->_outDate->getTimestamp(), \Zend_Date::TIMESTAMP);
            $zendDate->setTimezone('UTC');
            return $zendDate;
        }

        return $this->_outDate->format('Y-m-d H:i:s');
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param float $data
     * @return \IvozProvider\Model\Raw\Invoices
     */
    public function setTotal($data)
    {

        if ($this->_total != $data) {
            $this->_logChange('total', $this->_total, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_total = $data;

        } else if (!is_null($data)) {
            $this->_total = (float) $data;

        } else {
            $this->_total = $data;
        }
        return $this;
    }

    /**
     * Gets column total
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->_total;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param float $data
     * @return \IvozProvider\Model\Raw\Invoices
     */
    public function setTaxRate($data)
    {

        if ($this->_taxRate != $data) {
            $this->_logChange('taxRate', $this->_taxRate, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_taxRate = $data;

        } else if (!is_null($data)) {
            $this->_taxRate = (float) $data;

        } else {
            $this->_taxRate = $data;
        }
        return $this;
    }

    /**
     * Gets column taxRate
     *
     * @return float
     */
    public function getTaxRate()
    {
        return $this->_taxRate;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param float $data
     * @return \IvozProvider\Model\Raw\Invoices
     */
    public function setTotalWithTax($data)
    {

        if ($this->_totalWithTax != $data) {
            $this->_logChange('totalWithTax', $this->_totalWithTax, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_totalWithTax = $data;

        } else if (!is_null($data)) {
            $this->_totalWithTax = (float) $data;

        } else {
            $this->_totalWithTax = $data;
        }
        return $this;
    }

    /**
     * Gets column totalWithTax
     *
     * @return float
     */
    public function getTotalWithTax()
    {
        return $this->_totalWithTax;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Invoices
     */
    public function setStatus($data)
    {

        if ($this->_status != $data) {
            $this->_logChange('status', $this->_status, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_status = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_statusAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for status'));
            }
            $this->_status = (string) $data;

        } else {
            $this->_status = $data;
        }
        return $this;
    }

    /**
     * Gets column status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->_status;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Invoices
     */
    public function setCompanyId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_companyId != $data) {
            $this->_logChange('companyId', $this->_companyId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_companyId = $data;

        } else if (!is_null($data)) {
            $this->_companyId = (int) $data;

        } else {
            $this->_companyId = $data;
        }
        return $this;
    }

    /**
     * Gets column companyId
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->_companyId;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Invoices
     */
    public function setBrandId($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_brandId != $data) {
            $this->_logChange('brandId', $this->_brandId, $data);
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
     * @return \IvozProvider\Model\Raw\Invoices
     */
    public function setPdfFileFileSize($data)
    {

        if ($this->_pdfFileFileSize != $data) {
            $this->_logChange('pdfFileFileSize', $this->_pdfFileFileSize, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_pdfFileFileSize = $data;

        } else if (!is_null($data)) {
            $this->_pdfFileFileSize = (int) $data;

        } else {
            $this->_pdfFileFileSize = $data;
        }
        return $this;
    }

    /**
     * Gets column pdfFileFileSize
     *
     * @return int
     */
    public function getPdfFileFileSize()
    {
        return $this->_pdfFileFileSize;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Invoices
     */
    public function setPdfFileMimeType($data)
    {

        if ($this->_pdfFileMimeType != $data) {
            $this->_logChange('pdfFileMimeType', $this->_pdfFileMimeType, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_pdfFileMimeType = $data;

        } else if (!is_null($data)) {
            $this->_pdfFileMimeType = (string) $data;

        } else {
            $this->_pdfFileMimeType = $data;
        }
        return $this;
    }

    /**
     * Gets column pdfFileMimeType
     *
     * @return string
     */
    public function getPdfFileMimeType()
    {
        return $this->_pdfFileMimeType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\Invoices
     */
    public function setPdfFileBaseName($data)
    {

        if ($this->_pdfFileBaseName != $data) {
            $this->_logChange('pdfFileBaseName', $this->_pdfFileBaseName, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_pdfFileBaseName = $data;

        } else if (!is_null($data)) {
            $this->_pdfFileBaseName = (string) $data;

        } else {
            $this->_pdfFileBaseName = $data;
        }
        return $this;
    }

    /**
     * Gets column pdfFileBaseName
     *
     * @return string
     */
    public function getPdfFileBaseName()
    {
        return $this->_pdfFileBaseName;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\Invoices
     */
    public function setInvoiceTemplateId($data)
    {

        if ($this->_invoiceTemplateId != $data) {
            $this->_logChange('invoiceTemplateId', $this->_invoiceTemplateId, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_invoiceTemplateId = $data;

        } else if (!is_null($data)) {
            $this->_invoiceTemplateId = (int) $data;

        } else {
            $this->_invoiceTemplateId = $data;
        }
        return $this;
    }

    /**
     * Gets column invoiceTemplateId
     *
     * @return int
     */
    public function getInvoiceTemplateId()
    {
        return $this->_invoiceTemplateId;
    }

    /**
     * Sets parent relation Brand
     *
     * @param \IvozProvider\Model\Raw\Brands $data
     * @return \IvozProvider\Model\Raw\Invoices
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

        $this->_setLoaded('InvoicesIbfk1');
        return $this;
    }

    /**
     * Gets parent Brand
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function getBrand($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'InvoicesIbfk1';

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
     * Sets parent relation Company
     *
     * @param \IvozProvider\Model\Raw\Companies $data
     * @return \IvozProvider\Model\Raw\Invoices
     */
    public function setCompany(\IvozProvider\Model\Raw\Companies $data)
    {
        $this->_Company = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setCompanyId($primaryKey);
        }

        $this->_setLoaded('InvoicesIbfk2');
        return $this;
    }

    /**
     * Gets parent Company
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Companies
     */
    public function getCompany($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'InvoicesIbfk2';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_Company = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_Company;
    }

    /**
     * Sets parent relation InvoiceTemplate
     *
     * @param \IvozProvider\Model\Raw\InvoiceTemplates $data
     * @return \IvozProvider\Model\Raw\Invoices
     */
    public function setInvoiceTemplate(\IvozProvider\Model\Raw\InvoiceTemplates $data)
    {
        $this->_InvoiceTemplate = $data;

        $primaryKey = $data->getPrimaryKey();
        if (is_array($primaryKey)) {
            $primaryKey = $primaryKey['id'];
        }

        if (!is_null($primaryKey)) {
            $this->setInvoiceTemplateId($primaryKey);
        }

        $this->_setLoaded('InvoicesIbfk4');
        return $this;
    }

    /**
     * Gets parent InvoiceTemplate
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\InvoiceTemplates
     */
    public function getInvoiceTemplate($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'InvoicesIbfk4';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('parent', $fkName, $this, $where, $orderBy);
            $this->_InvoiceTemplate = array_shift($related);
            if ($usingDefaultArguments) {
                $this->_setLoaded($fkName);
            }
        }

        return $this->_InvoiceTemplate;
    }

    /**
     * Sets dependent relations FixedCostsRelInvoices_ibfk_3
     *
     * @param array $data An array of \IvozProvider\Model\Raw\FixedCostsRelInvoices
     * @return \IvozProvider\Model\Raw\Invoices
     */
    public function setFixedCostsRelInvoices(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_FixedCostsRelInvoices === null) {

                $this->getFixedCostsRelInvoices();
            }

            $oldRelations = $this->_FixedCostsRelInvoices;

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

        $this->_FixedCostsRelInvoices = array();

        foreach ($data as $object) {
            $this->addFixedCostsRelInvoices($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations FixedCostsRelInvoices_ibfk_3
     *
     * @param \IvozProvider\Model\Raw\FixedCostsRelInvoices $data
     * @return \IvozProvider\Model\Raw\Invoices
     */
    public function addFixedCostsRelInvoices(\IvozProvider\Model\Raw\FixedCostsRelInvoices $data)
    {
        $this->_FixedCostsRelInvoices[] = $data;
        $this->_setLoaded('FixedCostsRelInvoicesIbfk3');
        return $this;
    }

    /**
     * Gets dependent FixedCostsRelInvoices_ibfk_3
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\FixedCostsRelInvoices
     */
    public function getFixedCostsRelInvoices($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'FixedCostsRelInvoicesIbfk3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_FixedCostsRelInvoices = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_FixedCostsRelInvoices;
    }

    /**
     * Sets dependent relations kam_acc_cdrs_ibfk_3
     *
     * @param array $data An array of \IvozProvider\Model\Raw\KamAccCdrs
     * @return \IvozProvider\Model\Raw\Invoices
     */
    public function setKamAccCdrs(array $data, $deleteOrphans = false)
    {
        if ($deleteOrphans === true) {

            if ($this->_KamAccCdrs === null) {

                $this->getKamAccCdrs();
            }

            $oldRelations = $this->_KamAccCdrs;

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

        $this->_KamAccCdrs = array();

        foreach ($data as $object) {
            $this->addKamAccCdrs($object);
        }

        return $this;
    }

    /**
     * Sets dependent relations kam_acc_cdrs_ibfk_3
     *
     * @param \IvozProvider\Model\Raw\KamAccCdrs $data
     * @return \IvozProvider\Model\Raw\Invoices
     */
    public function addKamAccCdrs(\IvozProvider\Model\Raw\KamAccCdrs $data)
    {
        $this->_KamAccCdrs[] = $data;
        $this->_setLoaded('KamAccCdrsIbfk3');
        return $this;
    }

    /**
     * Gets dependent kam_acc_cdrs_ibfk_3
     *
     * @param string or array $where
     * @param string or array $orderBy
     * @param boolean $avoidLoading skip data loading if it is not already
     * @return array The array of \IvozProvider\Model\Raw\KamAccCdrs
     */
    public function getKamAccCdrs($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'KamAccCdrsIbfk3';

        $usingDefaultArguments = is_null($where) && is_null($orderBy);
        if (!$usingDefaultArguments) {
            $this->setNotLoaded($fkName);
        }

        $dontSkipLoading = !($avoidLoading);
        $notLoadedYet = !($this->_isLoaded($fkName));

        if ($dontSkipLoading && $notLoadedYet) {
            $related = $this->getMapper()->loadRelated('dependent', $fkName, $this, $where, $orderBy);
            $this->_KamAccCdrs = $related;
            $this->_setLoaded($fkName);
        }

        return $this->_KamAccCdrs;
    }

    /**
     * Returns the mapper class for this model
     *
     * @return IvozProvider\Mapper\Sql\Invoices
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\Invoices')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\Invoices);

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
     * @return null | \IvozProvider\Model\Validator\Invoices
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\Invoices')) {

                $this->setValidator(new \IvozProvider\Validator\Invoices);
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
     * @see \Mapper\Sql\Invoices::delete
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