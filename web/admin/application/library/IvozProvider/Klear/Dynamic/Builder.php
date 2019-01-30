<?php
namespace IvozProvider\Klear\Dynamic;

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\BrandUrl\BrandUrl;
use Ivoz\Provider\Domain\Model\BrandUrl\BrandUrlDto;
use IvozProvider\Klear\Dynamic\Config\MainOperator;
use IvozProvider\Klear\Dynamic\Config\BrandOperator;
use IvozProvider\Klear\Dynamic\Config\CompanyAdmin;

class Builder
{
    /**
     *
     * @var BrandDto
     */
    protected static $_brand;

    /**
     * @var BrandUrlDto
     */
    protected static $_URL;

    public static function factory()
    {
        $currentURL = self::_loadCurrentURL();
        self::_resolveBrand($currentURL);

        $brandURLType = self::$_URL->getUrlType();

        $dynamic = null;
        if ($brandURLType == 'god') {
            $dynamic = new MainOperator();
        } elseif ($brandURLType == 'brand') {
            $dynamic = new BrandOperator();
        } elseif ($brandURLType == 'admin') {
            $dynamic = new CompanyAdmin();
        } elseif ($brandURLType == 'user') {
            header("Location: " . $currentURL . '/portal');
            exit;
        } else {
            self::_failConfiguration();
        }

        if (self::$_brand) {
            $dynamic->setBrand(self::$_brand);
        }

        $dynamic->setBrandUrl(self::$_URL);
        $dynamic->setLogo(self::_resolveLogo());

        return $dynamic;
    }

    /**
     * return current REQUEST_URI, both with/without at the end '/'
     * @return array
     */
    protected static function _loadCurrentURL()
    {
        $front = \Zend_Controller_Front::getInstance();
        $request = $front->getRequest();

        $curURL = $request->getScheme() . '://'
                . $request->getHttpHost();

        return $curURL;
    }

    protected static function _resolveBrand($url)
    {
        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        self::$_URL = $dataGateway->findOneBy(
            BrandUrl::class,
            [
                "BrandUrl.url = '" . $url . "'"
            ]
        );


        if (!self::$_URL instanceof BrandUrlDto) {
            self::$_URL = new BrandUrlDto();
            self::$_URL
                ->setBrandId(null)
                ->setName('Global Administration portal')
                ->setUrlType('god')
                ->setKlearTheme('redmond');

            return false;
        }

        if (self::$_URL->getUrlType() === 'god') {
            return false;
        }

        self::$_brand  = $dataGateway->find(
            Brand::class,
            self::$_URL->getBrandId()
        );
    }

    public static function _failConfiguration()
    {
        throw new \Klear_Exception_Default('URL not configured in BrandURLs', 404);
    }

    protected static function _resolveLogo()
    {
        $brandURLLogoBaseName = self::$_URL->getLogoBaseName();
        if (!empty($brandURLLogoBaseName)) {
            return "fso/klearBrandUrl/".self::$_URL->getId()."-".$brandURLLogoBaseName;
        }

        if (!self::$_brand) {
            return null;
        }

        $brandLogoBaseName = self::$_brand->getLogoBaseName();
        if (!empty($brandLogoBaseName)) {
            return "fso/klearBrand/".self::$_brand->getId()."-".$brandLogoBaseName;
        }

        return null;
    }
}
