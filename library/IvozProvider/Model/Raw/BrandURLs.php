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
class BrandURLs extends ModelAbstract
{
    /*
     * @var \Iron_Model_Fso
     */
    protected $_logoFso;

    protected $_urlTypeAcceptedValues = array(
        'god',
        'brand',
        'admin',
        'user',
    );

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
     * Database var type varchar
     *
     * @var string
     */
    protected $_url;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_klearTheme;

    /**
     * [enum:god|brand|admin|user]
     * Database var type varchar
     *
     * @var string
     */
    protected $_urlType;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_name;

    /**
     * [FSO]
     * Database var type int
     *
     * @var int
     */
    protected $_logoFileSize;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_logoMimeType;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_logoBaseName;

    /**
     * Database var type varchar
     *
     * @var string
     */
    protected $_userTheme;


    /**
     * Parent relation BrandURLs_ibfk_1
     *
     * @var \IvozProvider\Model\Raw\Brands
     */
    protected $_Brand;


    protected $_columnsList = array(
        'id'=>'id',
        'brandId'=>'brandId',
        'url'=>'url',
        'klearTheme'=>'klearTheme',
        'urlType'=>'urlType',
        'name'=>'name',
        'logoFileSize'=>'logoFileSize',
        'logoMimeType'=>'logoMimeType',
        'logoBaseName'=>'logoBaseName',
        'userTheme'=>'userTheme',
    );

    /**
     * Sets up column and relationship lists
     */
    public function __construct()
    {
        $this->setColumnsMeta(array(
            'urlType'=> array('enum:god|brand|admin|user'),
            'logoFileSize'=> array('FSO'),
        ));

        $this->setMultiLangColumnsList(array(
        ));

        $this->setAvailableLangs(array('es', 'en'));

        $this->setParentList(array(
            'BrandURLsIbfk1'=> array(
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
        $this->_logoFso = new \Iron_Model_Fso($this, $this->getLogoSpecs());

        return $this;
    }

    public function getFileObjects()
    {

        return array('logo');
    }

    public function getLogoSpecs()
    {
        return array(
            'basePath' => 'logo',
            'sizeName' => 'logoFileSize',
            'mimeName' => 'logoMimeType',
            'baseNameName' => 'logoBaseName',
        );
    }

    public function putLogo($filePath = '',$baseName = '')
    {
        $this->_logoFso->put($filePath);

        if (!empty($baseName)) {

            $this->_logoFso->setBaseName($baseName);
        }
    }

    public function fetchLogo($autoload = true)
    {
        if ($autoload === true && $this->getlogoFileSize() > 0) {

            $this->_logoFso->fetch();
        }

        return $this->_logoFso;
    }

    public function removeLogo()
    {
        $this->_logoFso->remove();
        $this->_logoFso = null;

        return true;
    }

    public function getLogoUrl($profile)
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
     * @return \IvozProvider\Model\Raw\BrandURLs
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
     * @return \IvozProvider\Model\Raw\BrandURLs
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
     * @param string $data
     * @return \IvozProvider\Model\Raw\BrandURLs
     */
    public function setUrl($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_url != $data) {
            $this->_logChange('url', $this->_url, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_url = $data;

        } else if (!is_null($data)) {
            $this->_url = (string) $data;

        } else {
            $this->_url = $data;
        }
        return $this;
    }

    /**
     * Gets column url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->_url;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\BrandURLs
     */
    public function setKlearTheme($data)
    {

        if ($this->_klearTheme != $data) {
            $this->_logChange('klearTheme', $this->_klearTheme, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_klearTheme = $data;

        } else if (!is_null($data)) {
            $this->_klearTheme = (string) $data;

        } else {
            $this->_klearTheme = $data;
        }
        return $this;
    }

    /**
     * Gets column klearTheme
     *
     * @return string
     */
    public function getKlearTheme()
    {
        return $this->_klearTheme;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\BrandURLs
     */
    public function setUrlType($data)
    {

        if (is_null($data)) {
            throw new \InvalidArgumentException(_('Required values cannot be null'));
        }
        if ($this->_urlType != $data) {
            $this->_logChange('urlType', $this->_urlType, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_urlType = $data;

        } else if (!is_null($data)) {
            if (!in_array($data, $this->_urlTypeAcceptedValues) && !empty($data)) {
                throw new \InvalidArgumentException(_('Invalid value for urlType'));
            }
            $this->_urlType = (string) $data;

        } else {
            $this->_urlType = $data;
        }
        return $this;
    }

    /**
     * Gets column urlType
     *
     * @return string
     */
    public function getUrlType()
    {
        return $this->_urlType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\BrandURLs
     */
    public function setName($data)
    {

        if ($this->_name != $data) {
            $this->_logChange('name', $this->_name, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_name = $data;

        } else if (!is_null($data)) {
            $this->_name = (string) $data;

        } else {
            $this->_name = $data;
        }
        return $this;
    }

    /**
     * Gets column name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param int $data
     * @return \IvozProvider\Model\Raw\BrandURLs
     */
    public function setLogoFileSize($data)
    {

        if ($this->_logoFileSize != $data) {
            $this->_logChange('logoFileSize', $this->_logoFileSize, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_logoFileSize = $data;

        } else if (!is_null($data)) {
            $this->_logoFileSize = (int) $data;

        } else {
            $this->_logoFileSize = $data;
        }
        return $this;
    }

    /**
     * Gets column logoFileSize
     *
     * @return int
     */
    public function getLogoFileSize()
    {
        return $this->_logoFileSize;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\BrandURLs
     */
    public function setLogoMimeType($data)
    {

        if ($this->_logoMimeType != $data) {
            $this->_logChange('logoMimeType', $this->_logoMimeType, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_logoMimeType = $data;

        } else if (!is_null($data)) {
            $this->_logoMimeType = (string) $data;

        } else {
            $this->_logoMimeType = $data;
        }
        return $this;
    }

    /**
     * Gets column logoMimeType
     *
     * @return string
     */
    public function getLogoMimeType()
    {
        return $this->_logoMimeType;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\BrandURLs
     */
    public function setLogoBaseName($data)
    {

        if ($this->_logoBaseName != $data) {
            $this->_logChange('logoBaseName', $this->_logoBaseName, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_logoBaseName = $data;

        } else if (!is_null($data)) {
            $this->_logoBaseName = (string) $data;

        } else {
            $this->_logoBaseName = $data;
        }
        return $this;
    }

    /**
     * Gets column logoBaseName
     *
     * @return string
     */
    public function getLogoBaseName()
    {
        return $this->_logoBaseName;
    }

    /**
     * Sets column Stored in ISO 8601 format.     *
     * @param string $data
     * @return \IvozProvider\Model\Raw\BrandURLs
     */
    public function setUserTheme($data)
    {

        if ($this->_userTheme != $data) {
            $this->_logChange('userTheme', $this->_userTheme, $data);
        }

        if ($data instanceof \Zend_Db_Expr) {
            $this->_userTheme = $data;

        } else if (!is_null($data)) {
            $this->_userTheme = (string) $data;

        } else {
            $this->_userTheme = $data;
        }
        return $this;
    }

    /**
     * Gets column userTheme
     *
     * @return string
     */
    public function getUserTheme()
    {
        return $this->_userTheme;
    }

    /**
     * Sets parent relation Brand
     *
     * @param \IvozProvider\Model\Raw\Brands $data
     * @return \IvozProvider\Model\Raw\BrandURLs
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

        $this->_setLoaded('BrandURLsIbfk1');
        return $this;
    }

    /**
     * Gets parent Brand
     * TODO: Mejorar esto para los casos en que la relación no exista. Ahora mismo siempre se pediría el padre
     * @return \IvozProvider\Model\Raw\Brands
     */
    public function getBrand($where = null, $orderBy = null, $avoidLoading = false)
    {
        $fkName = 'BrandURLsIbfk1';

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
     * @return IvozProvider\Mapper\Sql\BrandURLs
     */
    public function getMapper()
    {
        if ($this->_mapper === null) {

            \Zend_Loader_Autoloader::getInstance()->suppressNotFoundWarnings(true);

            if (class_exists('\IvozProvider\Mapper\Sql\BrandURLs')) {

                $this->setMapper(new \IvozProvider\Mapper\Sql\BrandURLs);

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
     * @return null | \IvozProvider\Model\Validator\BrandURLs
     */
    public function getValidator()
    {
        if ($this->_validator === null) {

            if (class_exists('\IvozProvider\\Validator\BrandURLs')) {

                $this->setValidator(new \IvozProvider\Validator\BrandURLs);
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
     * @see \Mapper\Sql\BrandURLs::delete
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