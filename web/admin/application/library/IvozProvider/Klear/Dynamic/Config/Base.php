<?php
namespace IvozProvider\Klear\Dynamic\Config;

use Ivoz\Provider\Domain\Model\Brand\BrandDTO;
use Ivoz\Provider\Domain\Model\BrandUrl\BrandUrlDTO;
use Ivoz\Provider\Domain\Model\BrandUrl\BrandUrlInterface;
use IvozProvider\Klear\Auth\User;

abstract class Base extends \Klear_Model_Settings_Dynamic_Abstract
{
    /**
     *
     * @var BrandDTO
     */
    protected $_brand;

    /**
     * @var  BrandUrlDTO
     */
    protected $_brandURL;

    /**
     * @var User
     */
    protected $_user;


    protected $_title = '';
    protected $_subTitle = '';
    protected $_year = '2018';
    protected $_logo = "images/palmera90.png";

    protected $_sessionName = 'BrandOperatorSession';
    protected $_userMapper = 'IvozProvider\Klear\Auth\Administrator';

    protected $_timezone;

    /**
     *
     * @var Zend_Config
     */
    protected $_siteConfig;

    public function setBrand(BrandDTO $brand)
    {
        $this->_brand = $brand;
        return $this;
    }

    public function setLogo($logo)
    {
        $this->_logo = $logo;
        return $this;
    }

    public function setBrandUrl(BrandUrlDTO $brandURL)
    {
        $this->_brandURL = $brandURL;
        return $this;
    }

    public function setTimezone($timezone)
    {
        $this->_timezone = $timezone;
        return $this;
    }

    public function init($siteConfig)
    {
        $this->_siteConfig = $siteConfig;
        if (\Zend_Auth::getInstance()) {
            $identity = \Zend_Auth::getInstance()->getIdentity();
            if ($identity) {
                $this->_user = $identity;
                $this->_user->postLogin();
            }
        }
        $this->postInit();
    }

    public function processSiteName($sitename)
    {
        if (!isset($this->_brandURL)) {
            return $this->_title;
        }

        return sprintf('[%s]', $this->_brandURL->getName());
    }

    public function processSiteSubName($sitesubname)
    {
        return $this->_subTitle;
    }

    public function processLogo($logo)
    {
        if (!is_null($this->_logo)) {
            return $this->_logo;
        }

        return $logo;
    }

    public function processYear($year)
    {
        return $this->_year;
    }

    public function processLang($lang)
    {
        return $lang;
    }

    public function processLangs($langs)
    {
        return $langs;
    }

    public function processjQueryUI($jQueryUIconf)
    {
        $themeParser = new \Klear_Model_JQueryUIThemeParser;
        $themeParser->init();

        try {
            return $themeParser->getPathForTheme($this->_brandURL->getKlearTheme());
        } catch (\Exception $e) {
            return $themeParser->getPathForTheme('hot-sneaks');
        }
    }

    public function processCssExtended($cssExtended)
    {
        return $cssExtended;
    }

    public function processRawCss($rawCss)
    {
        return $rawCss;
    }

    public function processRawJavascripts($rawJavascripts)
    {
        return $rawJavascripts;
    }

    public function processTimezone($timezone)
    {
        return $timezone;
    }

    public function processSignature($signature)
    {
        if (!isset($this->_brandURL)) {
            return $signature;
        }

        return $this->_brandURL->getName();
    }

    public function processAuthConfig($authConfig)
    {
        $config = new \Zend_Config(array(), true);
        $config->merge($authConfig->getRaw());

        if ($this->_brand) {
            $config->brandId = $this->_brand->getId();
        }
        $config->session->name = $this->_sessionName;
        $config->userMapper = $this->_userMapper;

        $newAuthConfig = new \Klear_Model_ConfigParser();
        $newAuthConfig->setConfig($config);

        return $newAuthConfig;
    }
}
