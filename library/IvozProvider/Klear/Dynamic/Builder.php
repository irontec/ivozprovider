<?php
namespace IvozProvider\Klear\Dynamic;

use IvozProvider\Klear\Dynamic\Config\MainOperator;
use IvozProvider\Klear\Dynamic\Config\BrandOperator;
use IvozProvider\Klear\Dynamic\Config\CompanyAdmin;

class Builder
{
    /**
     *
     * @var \IvozProvider\Model\Brands
     */
    protected static $_brand;

    /**
     * @var  \IvozProvider\Model\BrandURLs
     */
    protected static $_brandURL;

    public static function factory()
    {
        $currentURLs = self::_loadCurrentURLs();
        self::_resolveBrand($currentURLs);

        $brandURLType = self::$_brandURL->getUrlType();

        $dynamic = null;
        if ($brandURLType == 'god') {
            $dynamic = new MainOperator();

        } elseif ($brandURLType == 'brand') {
            $dynamic = new BrandOperator();
        } elseif ($brandURLType == 'admin') {
            $dynamic = new CompanyAdmin();
        } elseif ($brandURLType == 'user') {

            header("Location: " . $currentURLs[1] . 'portal');
            exit;

        } else {
            self::_failConfiguration();
        }

        if (self::$_brand) {
            $dynamic->setBrand(self::$_brand);
        }

        $dynamic->setBrandUrl(self::$_brandURL);
        $dynamic->setLogo(self::_resolveLogo());

        return $dynamic;
    }

    /**
     * return current REQUEST_URI, both with/without at the end '/'
     * @return array
     */
    protected static function _loadCurrentURLs()
    {
        $front = \Zend_Controller_Front::getInstance();
        $request = $front->getRequest();

        $ret = array();

        $curURL = $request->getScheme() . '://'
                . $request->getHttpHost()
                . $front->getBaseUrl();

        if (substr($curURL,-1) === '/') {
            $altURL = substr($curURL,0,-1);
        } else {$front = \Zend_Controller_Front::getInstance();
        $request = $front->getRequest();

        $ret = array();

        $curURL = $request->getScheme() . '://'
                . $request->getHttpHost()
                . $front->getBaseUrl();
            $altURL = $curURL . '/';
        }

        return array($curURL, $altURL);
    }

    protected static function _resolveBrand($urls)
    {
        $brandURLMapper = new \IvozProvider\Mapper\Sql\BrandURLs();
        self::$_brandURL = $brandURLMapper->findOneByField('url', $urls);

        if (!self::$_brandURL instanceof \IvozProvider\Model\BrandURLs) {
            self::$_brandURL = new \IvozProvider\Model\BrandURLs();
            self::$_brandURL
                ->setName('Global Administration portal')
                ->setUrlType('god')
                ->setKlearTheme('redmond');

            return false;
        }

        if (self::$_brandURL->getUrlType() === 'god') {
            return false;
        }

        self::$_brand = self::$_brandURL->getBrand();
    }

    public static function _failConfiguration()
    {
        throw new \Klear_Exception_Default('URL not configured in BrandURLs', 404);
    }

    protected static function _resolveLogo()
    {
        $brandURLLogoBaseName = self::$_brandURL->getLogoBaseName();
        if (!empty($brandURLLogoBaseName)) {
            return "fso/klearBrandUrl/".self::$_brandURL->getPrimaryKey()."-".$brandURLLogoBaseName;
        }

        if (!self::$_brand) {
            return null;
        }

        $brandLogoBaseName = self::$_brand->getLogoBaseName();
        if (!empty($brandLogoBaseName)) {
            return "fso/klearBrand/".self::$_brand->getPrimaryKey()."-".$brandLogoBaseName;
        }

        return null;
    }
}
