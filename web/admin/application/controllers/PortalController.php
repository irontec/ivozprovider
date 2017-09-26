<?php

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class PortalController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $serverUrl = $this->view->serverUrl();
        $brandsMap = new Mappers\BrandURLs();
        $brand = $brandsMap->findOneByField('url', $serverUrl);

        if (!$this->_isBrandValid($brand)) {
            throw new Exception('Page not found', 404);
        }


    }

    public function indexAction()
    {
        // action body
    }

    protected function _isBrandValid($brand)
    {

        if (empty($brand)) {
            return false;
        }

        if ($brand->getUrlType() !== 'user') {
            return false;
        }

        return true;

    }

}