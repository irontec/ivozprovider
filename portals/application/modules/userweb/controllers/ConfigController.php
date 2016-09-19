<?php
/**
 * Config
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Userweb_ConfigController extends Iron_Controller_Rest_BaseController
{

    public function headAction()
    {
        $this->_response->setHttpResponseCode(200);
    }

    public function optionsAction()
    {

        $options = array(
            'GET' => array()
        );

        $this->_response->setHttpResponseCode(200);
        $this->_helper->json($options);

    }

    public function indexAction()
    {
        $serverUrl = $this->view->serverUrl();

        $mapper = new Mappers\BrandURLs();
        $currentBrand = $mapper->findOneByField('url', $serverUrl);

        if (!empty($currentBrand)) {
            if (!$currentBrand) {
                $currentBrand = new IvozProvider\Model\BrandURLs();
            }

            $image = $currentBrand->getLogoUrl('brandUrl');

            $theme = 'default';
            if (trim($currentBrand->getUserTheme()) != '') {
                $theme = $currentBrand->getUserTheme();
            }

            $data = array(
                'name' => $currentBrand->getName(),
                'logo' => $image,
                'theme' => $theme
            );

            $this->addViewData($data);
            $this->status->setCode(200);

        } else {
            $this->addViewData(array());
            $this->status->setCode(204);
        }
    }

}
