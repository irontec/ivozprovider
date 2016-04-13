<?php
/**
 * Config
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Rest_ConfigController extends Iron_Controller_Rest_BaseController
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

        $imageUrl = $serverUrl . '/fso/brandUrl/';

        $mapper = new Mappers\BrandURLs();
        $currentBrand = $mapper->findOneByField('url', $serverUrl);

        if (!empty($currentBrand)) {

            $logo = array(
                $currentBrand->getId(),
                $currentBrand->getLogoBaseName()
            );
            $image = $imageUrl . implode('-', $logo);

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